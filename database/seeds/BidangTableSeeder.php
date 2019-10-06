<?php

use Illuminate\Database\Seeder;

class BidangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('bidang')->delete();
        $data = [
        	['uid_bidang'=>2, 'kode_bidang'=>'I', 'nama_bidang'=>'Instalasi Pemanfaatan Tenaga Listrik'],
        	['uid_bidang'=>3, 'kode_bidang'=>'P', 'nama_bidang'=>'Pembangkitan Tenaga Listrik'],
        ];
        \DB::table('bidang')->insert($data);
    }
}
