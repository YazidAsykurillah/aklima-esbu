<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadanUsahaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badan_usaha', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid_badan_usaha');
            $table->integer('bentuk_badan_usaha_uid');
            $table->string('nama_badan_usaha');
            $table->text('alamat_badan_usaha');
            $table->bigInteger('kelurahan_uid');
            $table->bigInteger('kecamatan_uid');
            $table->bigInteger('kota_uid');
            $table->string('no_telp_kantor')->nullable();
            $table->string('no_hp_kantor')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('website')->nullable();
            $table->string('nik_penanggung_jawab')->nullable();
            $table->string('nama_penanggung_jawab')->nullable();
            $table->string('jenis_kewarganegaraan')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('passport')->nullable();
            $table->string('no_telepon_penanggung_jawab')->nullable();
            $table->string('email_perusahaan')->nullable();
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
        Schema::dropIfExists('badan_usaha');
    }
}
