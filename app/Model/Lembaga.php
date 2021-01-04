<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembaga';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['id','lembaga'];
    protected $guarded = [];


    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_lembaga');
    }
}
