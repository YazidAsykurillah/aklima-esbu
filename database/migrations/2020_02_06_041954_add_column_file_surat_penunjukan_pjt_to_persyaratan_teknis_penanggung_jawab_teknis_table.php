<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFileSuratPenunjukanPjtToPersyaratanTeknisPenanggungJawabTeknisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persyaratan_teknis_penanggung_jawab_teknis', function (Blueprint $table) {
            $table->text('file_surat_penunjukan_pjt')->nullable()->after('file_pernyataan_pjt');
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
            $table->dropColumn('file_surat_penunjukan_pjt');
        });
    }
}
