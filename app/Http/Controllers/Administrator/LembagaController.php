<?php
namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MainHelp;
use DataTables;
use App\Model\Lembaga;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Validator;
use Session;
use Auth;
use Str;
use Response;
use Illuminate\Support\Facades\Input;


class LembagaController extends Controller
{
    protected $repo;

    protected $view     = 'admin.lembaga.';
    protected $route    = 'administrator/lembaga/';
    protected $title    = 'Lembaga';

    public function __construct(Lembaga $repo){
        $this->repo = $repo;
    }

    public function datatable(Request $request){
        $query = $this->repo::orderBy('id', 'desc');
        return Datatables::eloquent($query)
            ->addIndexColumn()
            ->make(true);
    }

    public function index(){
        return view($this->view.'index', ['title' => $this->title, 'route' => $this->route]);
    }

    public function create()
    {
        return view($this->view.'create',['route' => $this->route, 'title' => $this->title]);
    }

    public function store(Request $request)
    {
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules->all(), $this->messages());
        $validator->setAttributeNames($this->attributes());
        if ($validator->fails()) {
            return redirect($this->route.'create')->withErrors($validator)->withInput();
        }
        try {
            $store = new $this->repo;
                $store->lembaga = $request->lembaga;
                $store->status = $request->status;
            $store->save();
        } catch (\Exception $e) {
            return redirect($this->route)->with('status', $e->getMessage());
        }
        return redirect($this->route)->with('status', $this->title.' berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules->all(), $this->messages());
        $validator->setAttributeNames($this->attributes());
        if ($validator->fails()) {
            return redirect($this->route.$id.'/edit')->withErrors($validator)->withInput();
        }
        try {
            $store = $this->repo::find($id);
                $store->lembaga = $request->lembaga;
                $store->status = $request->status;
            $store->save();
        } catch (\Exception $e) {
            return redirect($this->route)->with('status', $e->getMessage());
        }
        return redirect($this->route)->with('status', $this->title.' berhasil diupdate.');
    }

    public function edit($id)
    {
        try {
            $data   = $this->repo::where('id', $id)->first();
            if(empty($data)){
                return redirect($this->route)->with('status','Terjadi Kesalahan! '.$this->title.' tidak dapat diakses.');
            }
        } catch (\Exception $e) {
            return redirect($this->route)->with('status','Terjadi Kesalahan! '.$this->title.' tidak dapat diedit.');
        }
        return view($this->view.'edit', ['data' => $data, 'route' => $this->route, 'title' => $this->title]);
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
            'lembaga' => 'required',
            'status' => 'required',
        ]);
    }

    private function attributes(){
        return [
            'lembaga' => 'Lembaga',
            'status' => 'Status'
        ];
    }

    private function messages(){
        return [
            'required' => ':attribute tidak boleh kosong.',
        ];
    }
}
