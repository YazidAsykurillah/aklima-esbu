<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AclTableSeeder::class);
        $this->call(BentukBadanUsahasTableSeeder::class);
        $this->call(JenisUsahaTableSeeder::class);
        $this->call(BidangTableSeeder::class);
        $this->call(SubBidangTableSeeder::class);
        $this->call(MatriksKualifikasiTableSeeder::class);
    }
}
