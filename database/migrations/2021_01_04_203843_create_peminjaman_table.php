<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_barang');
            $table->string('nama');
            $table->string('nik');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('jabatan');
            $table->string('alamat_rumah');
            $table->string('no_hp');
            $table->datetime('tanggal_mulai');
            $table->datetime('tanggal_selesai');
            $table->text('tujuan_penggunaan');
            $table->text('keterangan');
            $table->boolean('status')->default(0);
            $table->text('keterangan_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
