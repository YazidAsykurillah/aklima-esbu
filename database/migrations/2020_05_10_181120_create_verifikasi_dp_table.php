<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifikasiDpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_dp', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');

            $table->boolean('hasil_ver_dp_dk')->nullable()->default(NULL);
            $table->text('catatan_ver_dp_dk')->nullable()->default(NULL);

            $table->boolean('hasil_ver_dp_dd')->nullable()->default(NULL);
            $table->text('catatan_ver_dp_dd')->nullable()->default(NULL);

            $table->boolean('hasil_ver_dp_ps')->nullable()->default(NULL);
            $table->text('catatan_ver_dp_ps')->nullable()->default(NULL);

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
        Schema::dropIfExists('verifikasi_dp');
    }
}
