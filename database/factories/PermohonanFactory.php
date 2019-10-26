<?php

use Faker\Generator as Faker;

$factory->define(App\Permohonan::class, function (Faker $faker) {
    return [
    	'uid_permohonan' => $faker->unique()->numberBetween(1,100),
    	'jenis_usaha_uid' => \App\JenisUsaha::orderBy(\DB::raw('RAND()'))->first()->uid_jenis_usaha,
    	'jenis_sertifikasi' => 1,
    	'perpanjangan_ke' => 0,
    	'badan_usaha_uid' => \App\BadanUsaha::orderBy(\DB::raw('RAND()'))->first()->uid_badan_usaha,
    	'status'=>$faker->numberBetween(0,14)
    ];
});
