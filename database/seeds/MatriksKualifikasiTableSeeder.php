<?php

use Illuminate\Database\Seeder;

class MatriksKualifikasiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('matriks_kualifikasi')->delete();
        $data = [
        	[
        		"uid_matriks_kualifikasi"=>1, "jenis_usaha_uid"=>1, "bidang_uid"=>3, "sub_bidang_uid"=>91,
        		"kualifikasi"=>"Kecil", "modal_disetor_min"=>50000000, "modal_disetor_maks"=>150000000,
        		"pjt_jumlah"=>1, "pjt_level"=>3, "tt_jumlah"=>1, "tt_level"=>2, "batas_nilai_1_pekerjaan"=> "<= Rp. 700.000.000"
        	],
        ];
        \DB::table('matriks_kualifikasi')->insert($data);
    }
}
