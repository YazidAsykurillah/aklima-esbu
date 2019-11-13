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

            ['id'=>3, 'username'=>'frontdesk', 'name'=>'MR Frontdesk', 'email'=>'frontdesk@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
            ['id'=>4, 'username'=>'verifikator', 'name'=>'MR verifikator', 'email'=>'verifikator@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
            ['id'=>5, 'username'=>'auditor', 'name'=>'MR auditor', 'email'=>'auditor@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
            ['id'=>6, 'username'=>'validator', 'name'=>'MR validator', 'email'=>'validator@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
            ['id'=>7, 'username'=>'dpp', 'name'=>'MR dpp', 'email'=>'dpp@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
            ['id'=>8, 'username'=>'dpd', 'name'=>'MR dpd', 'email'=>'dpd@gmail.com', 'password'=>\Hash::make('12345678'), 'type'=>'internal'],
           
            
        ];
        \DB::table('users')->insert($data);
    }
}
