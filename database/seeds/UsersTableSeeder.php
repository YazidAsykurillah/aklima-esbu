<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        $data = [
        	['id'=>1, 'username'=>'yazid', 'name'=>'Yazid', 'email'=>'yazasykurillah@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
        	['id'=>2, 'username'=>'marta', 'name'=>'Marta', 'email'=>'marta@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
            //Pusat
            ['id'=>3, 'username'=>'dpp03001', 'name'=>'DPP', 'email'=>'dpp03001@email.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
            //DPD
            ['id'=>4, 'username'=>'dpd01001', 'name'=>'DPD Jakarta', 'email'=>'dpd01001@email.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
            
        ];
        \DB::table('users')->insert($data);
    }
}
