<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktaPerubahanBuPaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akta_perubahan_bu_pa', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_verifikasi_pa');
            $table->bigInteger('uid_permohonan');
            $table->text('file_akta_pendirian_bu')->nullable();
            $table->string('nama_notaris');
            $table->string('judul_akta');
            $table->date('tanggal_akta');
            $table->string('nomor_akta');
            $table->text('hal_yang_diubah');
            $table->text('file_akta_perubahan_bu');
            $table->bigInteger('uid_akta_perubahan_bu')->nullable();
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
        Schema::dropIfExists('akta_perubahan_bu_pa');
    }
}
