<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLsbuWilayahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lsbu_wilayah', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_lsbu')->unique();
            $table->string('kode_lsbu');
            $table->string('nama_lsbu');
            $table->string('nama_lsbu_short');
            $table->string('kategori_lsbu');
            $table->string('jenis_lsbu');
            $table->text('alamat')->nullable();
            $table->bigInteger('provinsi_uid');
            $table->bigInteger('parent_lsbu_uid')->nullable();
            $table->string('api_keys');
            $table->boolean('is_active')->default(TRUE);
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
        Schema::dropIfExists('lsbu_wilayah');
    }
}
