<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //generate token
        \Artisan::call('integrator:generate-token');

        //Tarik Permohonan
        if(\Auth::user()->can('access-tarik-pendaftaran')){
            \Artisan::call('service:tarik-permohonan');    
        }
        
        return view('home');
    }

    public function getIdentitasProvinsi()
    {
        $response = [];
        $user = \Auth::user();
        $response['nama_provinsi'] = $user->provinsi ? $user->provinsi->nama_provinsi : 'PUSAT';
        return response()->json($response);
        
    }
}
