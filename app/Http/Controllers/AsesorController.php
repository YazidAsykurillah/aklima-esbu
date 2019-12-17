<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Asesor;
use App\User;

class AsesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //return datatables object
    
    public function datatables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $asesor = Asesor::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'asesor.*'
        ]);

        return Datatables::eloquent($asesor)
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function synchronize(Request $request)
    {
        $token = getCurrentActiveToken()['token'];
        
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;


        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('app.gatrik_base_uri'),
            'verify'=>false,
            'headers'=>[
                'Content-Type'=>'multipart/form-data',
                'Enctype'=>'multipart/form-data',
                'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                'Token'=> $token
            ]
            
        ]);
        $response = $client->post('Service/Ref/Asesor');
        try{
            
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            //Truncate moodel model
            Asesor::truncate();
            foreach($decode->result as $res){
                Asesor::create(
                    [
                        'uid_asesor'=>$res->uid_asesor,
                        'nik'=>$res->nik,
                        'nama_asesor'=>$res->nama_asesor,
                        'alamat'=>$res->alamat,
                        'email'=>$res->email,
                        'nomor_handphone'=>$res->nomor_handphone,
                        'is_active'=>$res->is_active,
                    ]
                );

                //Update or create user
                $user = User::updateOrCreate(
                    ['email'=>$res->email],
                    [

                        'name'=>$res->nama_asesor,
                        'username'=>$res->email,
                        'email'=>$res->email,
                        'password'=>bcrypt('12345678'),
                        'type'=>'internal',
                        'is_asesor'=>TRUE,
                        'uid_asesor'=>$res->uid_asesor
                    ]
                );
                \DB::table('role_user')->where('user_id', '=', $user->id)->delete();
                $role_user = [
                    ['role_id'=>3, 'user_id'=>$user->id],
                    ['role_id'=>4, 'user_id'=>$user->id],
                    ['role_id'=>5, 'user_id'=>$user->id],
                    ['role_id'=>6, 'user_id'=>$user->id],
                ];
                \DB::table('role_user')->insert($role_user);
                
            }

            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            return $ajaxResponse;
        }
        catch(GuzzleException $e){
            return $e;
        }
    }
}
