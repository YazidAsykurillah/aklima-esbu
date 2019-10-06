<?php

use Illuminate\Database\Seeder;

class JenisUsahaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('jenis_usaha')->delete();

        $data = [
            ['uid_jenis_usaha'=>1, 'kode_jenis_usaha'=>'a', 'nama_jenis_usaha'=>'Konsultasi Dalam Bidang Instalasi Penyediaan Tenaga Listrik'],
        	['uid_jenis_usaha'=>2, 'kode_jenis_usaha'=>'b', 'nama_jenis_usaha'=>'Pembangunan dan Pemasangan Instalasi Penyediaan Tenaga Listrik'],
        	['uid_jenis_usaha'=>3, 'kode_jenis_usaha'=>'c', 'nama_jenis_usaha'=>'Pemeriksaan dan Pengujian Instalasi Tenaga Listrik'],
        ];

        \DB::table('jenis_usaha')->insert($data);
    }
}
