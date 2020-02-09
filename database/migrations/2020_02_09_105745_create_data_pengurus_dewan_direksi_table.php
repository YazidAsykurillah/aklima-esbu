<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPengurusDewanDireksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pengurus_dewan_direksi', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_ver_dp_dewan_direksi')->nullable();
            $table->bigInteger('uid_dewan_direksi')->nullable();
            $table->bigInteger('uid_permohonan')->nullable();
            $table->enum('jenis_identitas', ['KTP', 'Passpor'])->nullable();
            $table->string('nama')->nullable();
            $table->string('nomor_identitas')->nullable();
            $table->string('nomor_passpor')->nullable();
            $table->string('nomor_ktp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('npwp')->nullable();
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
        Schema::dropIfExists('data_pengurus_dewan_direksi');
    }
}
