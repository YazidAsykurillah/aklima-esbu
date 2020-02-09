<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsesorPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesor_permohonan', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['tt', 'pjt'])->nullable()->default(NULL);
            $table->bigInteger('uid_permohonan');
            $table->bigInteger('uid_asesor');
            $table->bigInteger('uid_permohonan_asesor');
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
        Schema::dropIfExists('asesor_permohonan');
    }
}
