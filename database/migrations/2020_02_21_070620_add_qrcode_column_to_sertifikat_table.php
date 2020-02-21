<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQrcodeColumnToSertifikatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->text('qrcode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sertifikat', function (Blueprint $table) {
            $table->dropColumn('qrcode');
        });
    }
}
