<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('uid_permohonan')->nullable();
            $table->bigInteger('jenis_usaha_uid')->nullable();
            $table->integer('jenis_sertifikasi')->nullable();
            $table->integer('perpanjangan_ke')->nullable();
            $table->bigInteger('badan_usaha_uid')->nullable();
            $table->enum('status', ['0','1', '2', '4', '5', '6', '7', '10', '11', '12', '14'])
                    ->nullable()->default(NULL);
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
        Schema::dropIfExists('permohonan');
    }
}
