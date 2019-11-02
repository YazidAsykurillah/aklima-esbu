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
            $table->dropColumn('is_registration_confirmed');
            $table->dropColumn('is_default_password_has_changed');
        });
    }
}
