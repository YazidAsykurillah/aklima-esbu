<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNomorKtpAndNomorPassporToPersyaratanTeknisPenanggungJawabTeknisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persyaratan_teknis_penanggung_jawab_teknis', function (Blueprint $table) {
            $table->string('nomor_ktp')->nullable()->before('file_kartu_identitas');
            $table->string('nomor_passpor')->nullable()->before('file_kartu_identitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persyaratan_teknis_penanggung_jawab_teknis', function (Blueprint $table) {
            //
        });
    }
}
