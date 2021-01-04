<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserAddFieldInstansi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('jabatan');
            $table->string('alamat_rumah');
            $table->string('no_hp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nik');
            $table->dropColumn('id_lembaga');
            $table->dropColumn('jabatan');
            $table->dropColumn('alamat_rumah');
            $table->dropColumn('no_hp');
        });
    }
}
