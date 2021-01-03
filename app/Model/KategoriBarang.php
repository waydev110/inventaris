<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = 'kategori_barang';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['id','nama_kategori'];
    protected $guarded = [];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_kategori');
    }
}
