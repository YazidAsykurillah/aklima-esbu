<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ServiceIntegrator;

class ConfigurationController extends Controller
{
    public function renderServiceIntegratorView(Request $request)
    {
    	$service_integrator = ServiceIntegrator::where('is_active', TRUE)->first();
    	return view('configuration.service-integrator')
    		->with('service_integrator', $service_integrator);
    }
}
