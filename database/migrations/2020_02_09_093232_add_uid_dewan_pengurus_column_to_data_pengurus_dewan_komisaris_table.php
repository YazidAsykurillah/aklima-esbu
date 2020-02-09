<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUidDewanPengurusColumnToDataPengurusDewanKomisarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_pengurus_dewan_komisaris', function (Blueprint $table) {
            $table->bigInteger('uid_dewan_pengurus')->after('npwp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_pengurus_dewan_komisaris', function (Blueprint $table) {
            $table->dropColumn('uid_dewan_pengurus');
        });
    }
}
