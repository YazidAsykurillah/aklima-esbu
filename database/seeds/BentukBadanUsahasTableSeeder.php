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
        \DB::table('bentuk_badan_usahas')->delete();
        $data = [
        	['uid_bentuk_badan_usaha'=>1, 'nama_bentuk_badan_usaha'=>'BBU 1', 'nama_singkat'=>'BBU1'],
        	['uid_bentuk_badan_usaha'=>2, 'nama_bentuk_badan_usaha'=>'BBU 2', 'nama_singkat'=>'BBU2'],
        	['uid_bentuk_badan_usaha'=>3, 'nama_bentuk_badan_usaha'=>'BBU 3', 'nama_singkat'=>'BBU3'],
        ];
        \DB::table('bentuk_badan_usahas')->insert($data);
    }
}
