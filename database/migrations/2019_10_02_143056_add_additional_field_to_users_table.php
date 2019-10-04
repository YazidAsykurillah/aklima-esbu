<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('dokumen_pendukung')->nullable();
            $table->enum('bentuk_badan_usaha', ['PT', 'Koperasi', 'CV'])->nullable();
            $table->string('nama_badan_usaha')->nullable();
            $table->string('npwp_badan_usaha')->nullable();
            $table->string('scan_npwp')->nullable();
            $table->boolean('is_registration_confirmed')->default(FALSE)->comment('Define if the user has confirmed registration via email');
            $table->boolean('is_default_password_has_changed')->default(FALSE)->comment('Define if the user has already change his/her default password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('dokumen_pendukung');
            $table->dropColumn('bentuk_badan_usaha');
            $table->dropColumn('nama_badan_usaha');
            $table->dropColumn('npwp_badan_usaha');
            $table->dropColumn('scan_npwp');
            $table->dropColumn('is_registration_confirmed');
            $table->dropColumn('is_default_password_has_changed');
        });
    }
}
