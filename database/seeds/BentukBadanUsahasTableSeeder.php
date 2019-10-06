<?php

use Illuminate\Database\Seeder;

class BentukBadanUsahasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('bentuk_badan_usaha')->delete();
        $data = [
        	['uid_bentuk_badan_usaha'=>1, 'nama_bentuk_badan_usaha'=>'Perseroan Terbatas (PT)', 'nama_singkat'=>'PT'],
        	['uid_bentuk_badan_usaha'=>2, 'nama_bentuk_badan_usaha'=>'Persekutuan Komanditer (CV)', 'nama_singkat'=>'CV'],
        ];
        \DB::table('bentuk_badan_usaha')->insert($data);
    }
}
