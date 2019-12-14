<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\ServiceIntegrator;

class ConfigurationController extends Controller
{
	
    public function renderServiceIntegratorView(Request $request)
    {
    	$current_active_token = getCurrentActiveToken();
    	return view('configuration.service-integrator')
    		->with('current_active_token', $current_active_token);
    }

    public function testConnection(Request $request)
    {
    	$message = "";

		$client = new Client([
		    // Base URI is used with relative requests
		    'base_uri' => config('app.gatrik_base_uri'),
		    'verify'=>false,
		    'headers'=>[
		    	'Content-Type'=>'multipart/form-data',
		    	'Enctype'=>'multipart/form-data',
		    	'X-Lsbu-Key'=>config('app.x_lsbu_key')
		    ]
		    
		]);

		try{
			$response = $client->post('Service/Auth/Tes-Koneksi-API');
			$code = $response->getStatusCode(); // 200
			$body = $response->getBody();
			$contents = $body->getContents();
			$message = json_decode($contents)->message;
			return redirect()->back()
				->with('successMessage', $message);
		}
		catch(GuzzleException $e){
			dd($e);
		}
		
    }


    public function generateToken(Request $request)
    {
    	$message = "";

		$client = new Client([
		    // Base URI is used with relative requests
		    'base_uri' => config('app.gatrik_base_uri'),
		    'verify'=>false,
		    'headers'=>[
		    	'Content-Type'=>'multipart/form-data',
		    	'Enctype'=>'multipart/form-data',
		    	'X-Lsbu-Key'=>config('app.x_lsbu_key')
		    ]
		    
		]);

		try{
			$response = $client->post('Service/Auth/Generate-Token');
			$code = $response->getStatusCode(); // 200
			$body = $response->getBody();
			$contents = $body->getContents();

			$data = json_decode($contents);
			$message = $data->message;
			$token = $data->token;
			$expired = $data->expired;

			//create or update service integrator
			$serviceIntegrator = ServiceIntegrator::updateOrCreate(
			    ['token' => $token, 'expired' => $expired ,'is_active'=>TRUE]
			);

			return redirect()->back()
				->with('successMessage', $message);
		}
		catch(GuzzleException $e){
			dd($e);
		}
    }
}
