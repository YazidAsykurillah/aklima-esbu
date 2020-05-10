<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifikasiPtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_pt', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');

            $table->boolean('hasil_ver_pt')->nullable()->default(NULL);
            $table->text('catatan_ver_pt')->nullable()->default(NULL);

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
        Schema::dropIfExists('verifikasi_pt');
    }
}
