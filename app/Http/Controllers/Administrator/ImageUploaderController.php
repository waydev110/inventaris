<?php
namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Response;


class ImageUploaderController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        $validator->setAttributeNames($this->attributes());
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'success' => false
            ],200);
        }
        try {
            $file = $request->file('file');
            $filename = time()."_".$file->getClientOriginalName();
            $dir = 'images/news';
            $file->move($dir, $filename);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat upload gambar. Silahkan coba lagi, atau hubungi administrator.',
                'success' => false
            ],200);
        }
        return response()->json([
            'url' => url('images/news').'/'.$filename,
            'success' => true
        ],200);
    }

    private function rules(){
        return [
            'file' => 'required|image|mimes:jpeg,jpg|max:2048'
        ];
    }

    private function messages()
    {
        return [
            'file.required' => "Anda harus menggunakan tombol 'Pilih file' untuk memilih file mana yang ingin Anda unggah",
            'file.max' => "Ukuran gambar maksimum untuk diunggah adalah 2MB (2048 KB). Jika Anda mengunggah gambar, cobalah untuk mengurangi resolusinya menjadi di bawah 2MB"
        ];
    }

    private function attributes(){
        return [
            'file' => 'Gambar'
        ];
    }
}
