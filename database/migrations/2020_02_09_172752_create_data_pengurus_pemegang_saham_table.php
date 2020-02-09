<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPengurusPemegangSahamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pengurus_pemegang_saham', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');
            $table->bigInteger('uid_pemegang_saham')->nullable();
            $table->bigInteger('uid_verifikasi_dp')->nullable();
            $table->enum('jenis_identitas', ['KTP', 'Passpor'])->nullable();
            $table->string('nama')->nullable();
            $table->string('nomor_identitas')->nullable();
            $table->string('negara')->nullable();
            $table->string('nomor_passpor')->nullable();
            $table->string('nomor_ktp')->nullable();
            $table->integer('prosentase_kepemilikan_saham');
            $table->decimal('nominal_kepemilikan_saham', 20, 2);
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
        Schema::dropIfExists('data_pengurus_pemegang_saham');
    }
}
