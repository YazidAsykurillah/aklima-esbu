<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusDjkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_djk', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan');
            $table->string('tahap');
            $table->string('keterangan_tahap');
            $table->string('status');
            $table->string('keterangan_status');
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
        Schema::dropIfExists('status_djk');
    }
}
