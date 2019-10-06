<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceIntegratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_integrators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('x_lsbu_key');
            $table->string('token')->nullable();
            $table->date('expired')->nullable();
            $table->boolean('is_active')->default(FALSE);
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
        Schema::dropIfExists('service_integrators');
    }
}
