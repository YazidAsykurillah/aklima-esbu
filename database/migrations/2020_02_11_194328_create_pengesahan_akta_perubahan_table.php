<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengesahanAktaPerubahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengesahan_akta_perubahan', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_verifikasi_pa')->nullable();
            $table->bigInteger('uid_permohonan')->nullable();
            $table->text('file_pengesahan_akta_perubahan')->nullable();
            $table->string('nomor')->nullable();
            $table->string('tentang')->nullable();
            $table->date('tanggal')->nullable();
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
        Schema::dropIfExists('pengesahan_akta_perubahan');
    }
}
