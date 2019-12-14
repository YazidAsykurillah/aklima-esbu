<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLingkupPekerjaanLsbuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lingkup_pekerjaan_lsbu', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_lsbu_lingkup_pekerjaan')->unique();
            $table->bigInteger('uid_lsbu');
            $table->bigInteger('uid_jenis_usaha');
            $table->bigInteger('uid_bidang');
            $table->bigInteger('uid_sub_bidang');
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
        Schema::dropIfExists('lingkup_pekerjaan_lsbu');
    }
}
