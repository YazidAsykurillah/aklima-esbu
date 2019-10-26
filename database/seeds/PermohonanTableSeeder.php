<?php

use Illuminate\Database\Seeder;
use App\Permohonan;
class PermohonanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Permohonan::truncate();
        factory(App\Permohonan::class, 50)->create();
    }
}
