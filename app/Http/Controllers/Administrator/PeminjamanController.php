<?php
namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MainHelp;
use DataTables;
use App\Model\Peminjaman;
use App\Model\Barang;
use App\Model\Lembaga;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Validator;
use Session;
use Auth;
use Str;
use Response;
use Illuminate\Support\Facades\Input;


class PeminjamanController extends Controller
{
    protected $repo;

    protected $view     = 'admin.peminjaman.';
    protected $route    = 'peminjaman/';
    protected $title    = 'Peminjaman';

    public function __construct(Peminjaman $repo){
        $this->repo = $repo;
    }

    public function datatable(Request $request){
        $query = $this->repo::with('barang','lembaga');

        if($request->get('status') !== null){
            $query->where('status', '=', $request->get('status'));
        }

        return Datatables::eloquent($query)
            ->addColumn('tanggal', function ($query) {
                return $query->created_at->format('d/m/Y');
            })
            ->addColumn('tanggal_mulai', function ($query) {
                return $query->tanggal_mulai->format('d/m/Y H:i');
            })
            ->addColumn('tanggal_selesai', function ($query) {
                return $query->tanggal_selesai->format('d/m/Y H:i');
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function index(){
        $barangs = Barang::with('kategori')->get();
        return view($this->view.'index', ['barangs' => $barangs, 'title' => $this->title, 'route' => $this->route]);
    }

    public function create()
    {
        $barangs = Barang::with('kategori')->get();
        $lembaga = Lembaga::where('id', auth()->user()->id_lembaga)->first();
        return view($this->view.'create',['lembaga' => $lembaga->lembaga, 'barangs' => $barangs, 'route' => $this->route, 'title' => $this->title]);
    }

    public function store(Request $request)
    {
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules->all(), $this->messages());
        $validator->setAttributeNames($this->attributes());
        if ($validator->fails()) {
            return redirect($this->route.'create')->withErrors($validator)->withInput();
        }
        // return dd($request->all());
        try {
            $store = new $this->repo;
                $store->id_lembaga        = auth()->user()->id_lembaga;
                $store->nama              = $request->nama;
                $store->nik               = $request->nik;
                $store->id_barang         = $request->barang;
                $store->jabatan           = $request->jabatan;
                $store->alamat_rumah      = $request->alamat_rumah;
                $store->no_hp             = $request->no_hp;
                $store->tanggal_mulai     = Carbon::createFromFormat('d/m/Y', $request->tanggal_mulai)->format('Y-m-d').' '.$request->jam_mulai.':00';
                $store->tanggal_selesai     = Carbon::createFromFormat('d/m/Y', $request->tanggal_selesai)->format('Y-m-d').' '.$request->jam_selesai.':00';
                $store->tujuan_penggunaan = $request->tujuan_penggunaan;
                $store->keterangan        = $request->keterangan;
                $store->save();
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect($this->route)->with('status', $e->getMessage());
        }
        return redirect($this->route)->with('status', $this->title.' berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $rules = $this->rules();
        $rules->put('kode_barang', 'required|unique:barang,kode_barang,'.$id.',id');
        $rules->put('nama_barang', 'required|unique:barang,nama_barang,'.$id.',id');
        $validator = Validator::make($request->all(), $rules->all(), $this->messages());
        $validator->setAttributeNames($this->attributes());
        if ($validator->fails()) {
            return redirect($this->route.$id.'/edit')->withErrors($validator)->withInput();
        }

        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $filename = Str::slug($request->nama_barang).'.'.$file->getClientOriginalExtension();
            $file->move($this->dir, $filename);
            if ($file->isValid()) {
                return redirect($this->route)->with('status','Terjadi kesalahan saat upload gambar.');
            }
        }

        try {
            $store = $this->repo::find($id);
                $store->id_lembaga        = auth()->user()->id_lembaga;
                $store->nama              = $request->nama;
                $store->nik               = $request->nik;
                $store->id_barang         = $request->barang;
                $store->jabatan           = $request->jabatan;
                $store->alamat_rumah      = $request->alamat_rumah;
                $store->no_hp             = $request->no_hp;
                $store->tanggal_mulai     = Carbon::createFromFormat('d/m/Y', $request->tanggal_mulai)->format('Y-m-d').' '.$request->jam_mulai.':00';
                $store->tanggal_selesai     = Carbon::createFromFormat('d/m/Y', $request->tanggal_selesai)->format('Y-m-d').' '.$request->jam_selesai.':00';
                $store->tujuan_penggunaan = $request->tujuan_penggunaan;
                $store->keterangan        = $request->keterangan;
                $store->save();
        } catch (\Exception $e) {
            return redirect($this->route)->with('status', $e->getMessage());
        }
        return redirect($this->route)->with('status',$this->title.' berhasil diupdate.');
    }

    public function show($id)
    {
        $data   = $this->repo::with('kategori')->where('id', $id)->first();
        if(empty($data)){
            return redirect($this->route)->with('status','Terjadi Kesalahan! '.$this->title.' tidak dapat ditampilkan.');
        }
        return view($this->view.'show', ["data" => $data, "title" => $this->title, "route" => $this->route]);
    }

    public function edit($id)
    {
        try {
            $categories = KategoriBarang::get();
            $data   = $this->repo::where('id', $id)->first();
            if(empty($data)){
                return redirect($this->route)->with('status','Terjadi Kesalahan! '.$this->title.' tidak dapat diakses.');
            }
        } catch (\Exception $e) {
            return redirect($this->route)->with('status','Terjadi Kesalahan! '.$this->title.' tidak dapat diedit.');
        }
        return view($this->view.'edit', ['categories' => $categories, 'data' => $data, 'route' => $this->route, 'title' => $this->title]);
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->get('id');
            $data = $this->repo::where('id', $id);
            $data->delete();
            $message = $this->title.' berhasil dihapus.';
        } catch (\Exception $e) {
            $message = $this->title.' gagal dihapus.';
        }
        return response()->json(['message' => $message]);
    }

    public function jadwal(Request $request)
    {
        try {
            $id = $request->get('id');
            $data = $this->repo::with('lembaga','barang')
            ->where('id_barang', $id)
            ->where('status', 1)
            ->where('tanggal_selesai','>=', date('Y-m-d H:i:s'))
            ->get();
            $barang = Barang::where('id', $id)->first();
            $barang = $barang->nama_barang;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return response()->json(['message' => $message]);
        }
        return response()->json(['data' => $data, 'barang' => $barang]);
    }

    private function rules(){
        return collect([
            'nama' => 'required',
            'nik' => 'required',
            'barang' => 'required',
            'jabatan' => 'required',
            'alamat_rumah' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'tujuan_penggunaan' => 'required',
            'keterangan' => 'required',
        ]);
    }

    private function attributes(){
        return [
            'nama' => 'Nama',
            'nik' => 'NIK',
            'id_barang' => 'Peminjaman',
            'jabatan' => 'Jabatan',
            'alamat_rumah' => 'Alamat Rumah',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_selesai' => 'Tanggal Selesai',
            'tujuan_penggunaan' => 'Tujuan Penggunaan',
            'keterangan' => 'Keterangan Tambahan',
        ];
    }

    private function messages(){
        return [
            'required' => ':attribute tidak boleh kosong.'
        ];
    }
}
