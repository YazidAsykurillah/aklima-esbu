<?php

use Illuminate\Database\Seeder;

class SubBidangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sub_bidang')->delete();
        $data = [
        	[
        		'uid_sub_bidang'=>91, 'kode_sub_bidang'=>'101', 'nama_sub_bidang'=>'Pembangkit Listrik Tenaga Uap', 'uid_bidang'=>3, 'uid_jenis_usaha'=>1
        	],
        ];
        \DB::table('sub_bidang')->insert($data);
    }
}
