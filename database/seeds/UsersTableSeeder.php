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
            ['id'=>3, 'username'=>'ilman', 'name'=>'Ilman', 'email'=>'ilman@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
        ];
        \DB::table('users')->insert($data);
    }
}
