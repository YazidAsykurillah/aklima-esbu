<?php

use Illuminate\Database\Seeder;

class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Block table roles
	    DB::table('roles')->delete();
        $roles = [
        	['id'=>1, 'code'=>'SUP', 'name'=>'Super Admin', 'label'=>'User with this role  has full access to apllication'],
        	['id'=>2, 'code'=>'ADM', 'name'=>'Administrator', 'label'=>'User with this role has almost full access to apllication'],
        	['id'=>3, 'code'=>'FRD', 'name'=>'Front Desk', 'label'=>'Tenaga Teknik kantor wilayah LSBU'],
        	['id'=>4, 'code'=>'VER', 'name'=>'Verifikator', 'label'=>'Penanggung Jawab Teknik kantor wilayah LSBU'],
        	['id'=>5, 'code'=>'AUD', 'name'=>'Auditor', 'label'=>'Tenaga Teknik kantor pusat LSBU'],
        	['id'=>6, 'code'=>'VAL', 'name'=>'Validator', 'label'=>'Penanggung Jawab Teknik kantor pusat LSBU'],
        ];
        DB::table('roles')->insert($roles);
	    //ENDBlock table roles

        //Block table role_user
	    DB::table('role_user')->delete();
        $role_user = [
        	//Super Admin
        	['role_id'=>1, 'user_id'=>1],

        	//Administrators
        	['role_id'=>2, 'user_id'=>2],

            //Front Desks
            ['role_id'=>3, 'user_id'=>4],

            //Verifikators
            ['role_id'=>4, 'user_id'=>4],

            //Auditors
            ['role_id'=>5, 'user_id'=>3],

            //Validators
            ['role_id'=>6, 'user_id'=>3],
        ];
        DB::table('role_user')->insert($role_user);
        //ENDBlock table role_user

        //Block table permissions
        DB::table('permissions')->delete();
        $permissions = [
            //Access Master Data
            [ 'id'=>1 ,'slug'=>'access-master-data', 'description'=>'View Master Data Menu'],

            //Access Application Configuration
            [ 'id'=>2 ,'slug'=>'access-configuration', 'description'=>'View Configuration Menu'],

            //Access Application Service
            [ 'id'=>3 ,'slug'=>'access-service', 'description'=>'View Service Menu'],

        ];
        DB::table('permissions')->insert($permissions);
        //ENDBlock table permissions

        //Block table permission_role
        DB::table('permission_role')->delete();
        $permission_role = [
        	//Administrator privilleges
        	['permission_id'=>1, 'role_id'=>2],
        ];
        DB::table('permission_role')->insert($permission_role);
        //ENDBlock table permission_role
    }
}
