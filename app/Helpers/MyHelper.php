<?php
namespace App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Model\Barang;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Session;

class MyHelper{
    public static function getBarang(){
        $barangs = Barang::where('display', 1)->orderBy('nama_barang', 'asc')->get();
        return $barangs;
    }
}
?>
