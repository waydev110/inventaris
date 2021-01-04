<?php
namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MainHelp;
use DataTables;
use App\Model\Barang;
use App\Model\KategoriBarang;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Validator;
use Session;
use Auth;
use Str;
use Response;
use Illuminate\Support\Facades\Input;


class BarangController extends Controller
{
    protected $repo;

    protected $view     = 'admin.barang.';
    protected $route    = 'administrator/barang/';
    protected $dir      = 'images/barang/';
    protected $title    = 'Barang';

    public function __construct(Barang $repo){
        $this->repo = $repo;
    }

    public function datatable(Request $request){
        $query = $this->repo::with('kategori');

        if($request->get('kategori') !== null){
            $query->where('id_kategori', '=', $request->get('kategori'));
        }

        return Datatables::eloquent($query)
            ->addIndexColumn()
            ->make(true);
    }

    public function index(){
        $categories = KategoriBarang::get();
        return view($this->view.'index', ['categories' => $categories, 'title' => $this->title, 'route' => $this->route]);
    }

    public function create()
    {
        $categories = KategoriBarang::get();
        return view($this->view.'create',['categories' => $categories, 'route' => $this->route, 'title' => $this->title]);
    }

    public function store(Request $request)
    {
        $rules = $this->rules();
        $rules->put('kode_barang', 'required|unique:barang,kode_barang');
        $rules->put('nama_barang', 'required|unique:barang,nama_barang');
        $rules->put('gambar', 'required');
        $validator = Validator::make($request->all(), $rules->all(), $this->messages());
        $validator->setAttributeNames($this->attributes());
        if ($validator->fails()) {
            return redirect($this->route.'create')->withErrors($validator)->withInput();
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
            $store = new $this->repo;
                $store->kode_barang      = $request->kode_barang;
                $store->nama_barang      = $request->nama_barang;
                $store->id_kategori      = $request->kategori;
                $store->spesifikasi      = $request->spesifikasi;
                $store->display          = $request->display;
                if(isset($filename))
                    $store->gambar       = $filename;
                $store->save();
        } catch (\Exception $e) {
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
                $store->kode_barang      = $request->kode_barang;
                $store->nama_barang      = $request->nama_barang;
                $store->id_kategori      = $request->kategori;
                $store->spesifikasi      = $request->spesifikasi;
                $store->display          = $request->display;
                if(isset($filename))
                    $store->gambar       = $filename;
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

    private function rules(){
        return collect([
            'kategori' => 'required',
            'spesifikasi' => 'required',
        ]);
    }

    private function attributes(){
        return [
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'kategori' => 'Kategori',
            'spesifikasi' => 'Spesifikasi',
            'gambar' => 'Gambar'
        ];
    }

    private function messages(){
        return [
            'required' => ':attribute tidak boleh kosong.'
        ];
    }
}
