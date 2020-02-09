<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNomorSertifikatAndNomorRegistrasiToPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->string('nomor_sertifikat')->nullable()->after('asesor_pjt_id');
            $table->string('nomor_registrasi')->nullable()->after('asesor_pjt_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropColumn('nomor_sertifikat');
            $table->dropColumn('nomor_registrasi');
        });
    }
}
