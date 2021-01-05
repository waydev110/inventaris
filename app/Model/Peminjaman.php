<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    //
    protected $table = 'peminjaman';
    protected $dates = ['created_at', 'updated_at', 'tanggal_mulai', 'tanggal_selesai'];
    protected $fillable = ['id','id_barang','nama','nik','id_lembaga','jabatan','alamat_rumah','no_hp','tanggal_mulai','tanggal_selesai','tujuan_penggunaan','keterangan','status','keterangan_verifikasi'];
    protected $append = ['txt_status'];
    protected $guarded = [];

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'id_lembaga');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function getTxtStatusAttribute(){
        $status = $this->status;
        switch ($status) {
            case '0':
                    $text = 'MENUNGGU';
                break;
            case '1':
                    $text = 'DISETUJUI';
                break;
            case '2':
                    $text = 'DITOLAK';
                break;
        }
        return $text;
    }
}
