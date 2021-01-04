<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['id','kode_barang','nama_barang','id_kategori','spesifikasi', 'display'];
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategori');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_barang');
    }
}
