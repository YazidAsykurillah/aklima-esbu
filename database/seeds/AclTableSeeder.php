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

            ['id'=>7, 'code'=>'DPP', 'name'=>'DPP', 'label'=>'Staff DPP'],
            ['id'=>8, 'code'=>'DPD', 'name'=>'DPD', 'label'=>'Staff DPD'],
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
            ['role_id'=>3, 'user_id'=>3],

            //Verifikators
            ['role_id'=>4, 'user_id'=>4],

            //Auditors
            ['role_id'=>5, 'user_id'=>5],

            //Validators
            ['role_id'=>6, 'user_id'=>6],

            //DPP
            ['role_id'=>7, 'user_id'=>7],

            //DPD
            ['role_id'=>8, 'user_id'=>8],
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

            //Access Permohonan
            [ 'id'=>4 ,'slug'=>'view-permohonan', 'description'=>'View Permohonan'],
            [ 'id'=>5 ,'slug'=>'view-permohonan-all', 'description'=>'View Permohonan All'],
            [ 'id'=>6 ,'slug'=>'view-permohonan-0', 'description'=>'View Permohonan Status Menunggu Permohonan'],
            [ 'id'=>7 ,'slug'=>'view-permohonan-1', 'description'=>'View Permohonan Status Front Desk'],
            [ 'id'=>8 ,'slug'=>'view-permohonan-4', 'description'=>'View Permohonan Status Verifikator'],
            [ 'id'=>9 ,'slug'=>'view-permohonan-5', 'description'=>'View Permohonan Status Auditor'],
            [ 'id'=>10 ,'slug'=>'view-permohonan-6', 'description'=>'View Permohonan Status Validator'],
            [ 'id'=>11 ,'slug'=>'view-permohonan-7', 'description'=>'View Permohonan Status Evaluator'],
            [ 'id'=>12 ,'slug'=>'view-permohonan-10', 'description'=>'View Permohonan Status Top Approval'],
            [ 'id'=>13 ,'slug'=>'view-permohonan-11', 'description'=>'View Permohonan Status SBU Sudah diregistrasi'],
            [ 'id'=>14 ,'slug'=>'view-permohonan-12', 'description'=>'View Permohonan Status SBU sudah dicetak'],
            [ 'id'=>15 ,'slug'=>'view-permohonan-14', 'description'=>'View Permohonan Status SBU Sudah diterima Pemohon'],

        ];
        DB::table('permissions')->insert($permissions);
        //ENDBlock table permissions

        //Block table permission_role
        DB::table('permission_role')->delete();
        $permission_role = [
        	//Administrator privilleges
        	['permission_id'=>1, 'role_id'=>2],

            //Front Desk
            ['permission_id'=>4, 'role_id'=>3],
            ['permission_id'=>7, 'role_id'=>3],

            //Verifikator
            ['permission_id'=>4, 'role_id'=>4],
            ['permission_id'=>8, 'role_id'=>4],

            //Auditor
            ['permission_id'=>4, 'role_id'=>5],
            ['permission_id'=>9, 'role_id'=>5],

            //Validator
            ['permission_id'=>4, 'role_id'=>6],
            ['permission_id'=>10, 'role_id'=>6],

            //DPP
            ['permission_id'=>1, 'role_id'=>7],
            ['permission_id'=>2, 'role_id'=>7],
            ['permission_id'=>3, 'role_id'=>7],
            ['permission_id'=>4, 'role_id'=>7],
            ['permission_id'=>5, 'role_id'=>7],
            ['permission_id'=>6, 'role_id'=>7],
            ['permission_id'=>7, 'role_id'=>7],
            ['permission_id'=>8, 'role_id'=>7],
            ['permission_id'=>9, 'role_id'=>7],
            ['permission_id'=>10, 'role_id'=>7],
            ['permission_id'=>11, 'role_id'=>7],
            ['permission_id'=>12, 'role_id'=>7],
            ['permission_id'=>13, 'role_id'=>7],
            ['permission_id'=>14, 'role_id'=>7],
            ['permission_id'=>15, 'role_id'=>7],

            //DPD
            ['permission_id'=>4, 'role_id'=>8],
            ['permission_id'=>5, 'role_id'=>8],
            ['permission_id'=>6, 'role_id'=>8],
            ['permission_id'=>7, 'role_id'=>8],
            ['permission_id'=>8, 'role_id'=>8],
            ['permission_id'=>9, 'role_id'=>8],
            ['permission_id'=>10, 'role_id'=>8],
            ['permission_id'=>11, 'role_id'=>8],
            ['permission_id'=>12, 'role_id'=>8],
            ['permission_id'=>13, 'role_id'=>8],
            ['permission_id'=>14, 'role_id'=>8],
            ['permission_id'=>15, 'role_id'=>8],
        ];
        DB::table('permission_role')->insert($permission_role);
        //ENDBlock table permission_role
    }
}
