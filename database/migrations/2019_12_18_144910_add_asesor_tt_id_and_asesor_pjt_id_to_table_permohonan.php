<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAsesorTtIdAndAsesorPjtIdToTablePermohonan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonan', function(Blueprint $table){
            $table->bigInteger('asesor_tt_id')->nullable()->default(NULL)->after('status')->comment('Definisi relasi ke master asesor sebagai Asesor Tenaga Teknik / Frontdesk');
            $table->bigInteger('asesor_pjt_id')->nullable()->default(NULL)->after('asesor_tt_id')->comment('Definisi relasi ke master asesor sebagai Asesor Penanggung Jawab Teknik / Verifikator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permohonan', function(Blueprint $table){
            $table->dropColumn('asesor_tt_id');
            $table->dropColumn('asesor_pjt_id');
        });
    }
}
