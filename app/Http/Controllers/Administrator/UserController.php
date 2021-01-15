<?php
namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MainHelp;
use DataTables;
use App\Model\User;
use App\Model\Lembaga;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Validator;
use Session;
use Auth;
use Str;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    protected $repo;

    protected $view     = 'admin.user.';
    protected $route    = 'administrator/user/';
    protected $title    = 'User';

    public function __construct(User $repo){
        $this->repo = $repo;
    }

    public function datatable(Request $request){
        $query = $this->repo::with('lembaga')->where('id_lembaga', '<>', 0)->orderBy('users.id', 'desc');
        return Datatables::eloquent($query)
            ->addIndexColumn()
            ->make(true);
    }

    public function index(){
        return view($this->view.'index', ['route' => $this->route, 'title' => $this->title]);
    }

    public function create()
    {
        $lembaga = Lembaga::where('status', 1)->get();
        return view($this->view.'create',['lembaga' => $lembaga, 'route' => $this->route, 'title' => $this->title]);
    }

    public function store(Request $request)
    {
        $rules = $this->rules();
        $rules->put('password', 'required|confirmed');
        $validator = Validator::make($request->all(), $rules->all(), $this->messages());
        $validator->setAttributeNames($this->attributes());
        if ($validator->fails()) {
            return redirect($this->route.'create')->withErrors($validator)->withInput();
        }
        try {
            $store = new $this->repo;
                $store->name = $request->name;
                $store->nik = $request->nik;
                $store->email = $request->email;
                $store->id_lembaga = $request->id_lembaga;
                $store->jabatan = $request->jabatan;
                $store->alamat_rumah = $request->alamat_rumah;
                $store->no_hp = $request->no_hp;
                $store->password = Hash::make($request->password);
            $store->save();
            $store->assignRole('user');
        } catch (\Exception $e) {
            return redirect($this->route)->with('status', $e->getMessage());
        }
        return redirect($this->route)->with('status', $this->title.' berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $rules = $this->rules();
        $rules->put('email', 'required|email|unique:users,email,'.$id.',id');
        $validator = Validator::make($request->all(), $rules->all(), $this->messages());
        $validator->setAttributeNames($this->attributes());
        if ($validator->fails()) {
            return redirect($this->route.$id.'/edit')->withErrors($validator)->withInput();
        }
        try {
            $store = $this->repo::find($id);
                $store->name = $request->name;
                $store->nik = $request->nik;
                $store->email = $request->email;
                $store->id_lembaga = $request->id_lembaga;
                $store->jabatan = $request->jabatan;
                $store->alamat_rumah = $request->alamat_rumah;
                $store->no_hp = $request->no_hp;
            $store->save();
        } catch (\Exception $e) {
            return redirect($this->route)->with('status', $e->getMessage());
        }
        return redirect($this->route)->with('status', $this->title.' berhasil diupdate.');
    }

    public function edit($id)
    {
        try {
            $lembaga = Lembaga::where('status', 1)->get();
            $data   = $this->repo::where('id', $id)->first();
            if(empty($data)){
                return redirect($this->route)->with('status','Terjadi Kesalahan! '.$this->title.' tidak dapat diakses.');
            }
        } catch (\Exception $e) {
            return redirect($this->route)->with('status','Terjadi Kesalahan! '.$this->title.' tidak dapat diedit.');
        }
        return view($this->view.'edit', ['lembaga' => $lembaga,'data' => $data, 'route' => $this->route, 'title' => $this->title]);
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
            'nik' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'id_lembaga' => 'required',
            'jabatan' => 'required',
            'alamat_rumah' => 'required',
            'no_hp' => 'required',
        ]);
    }

    private function attributes(){
        return [
            'nik' => 'NIK',
            'name' => 'Nama User',
            'id_lembaga' => 'Lembaga',
            'jabatan' => 'Jabatan',
            'alamat_rumah' => 'Alamat Rumah',
            'no_hp' => 'No Handphone',
            'password' => 'Password',
            'conf_password' => 'Konfirmasi Password',
        ];
    }

    private function messages(){
        return [
            'required' => ':attribute tidak boleh kosong.',
            'confirmed' => ':attribute tidak sama.',
        ];
    }
}
