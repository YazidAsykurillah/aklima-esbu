<?php
	
	if(!function_exists('getCurrentActiveToken')){
		function getCurrentActiveToken()
		{
			$result['token']="";
			$result['expired']="";
			$serviceIntegrator = \App\ServiceIntegrator::where('is_active', TRUE);
			if($serviceIntegrator->count()){
				$latest = $serviceIntegrator->latest()->first();
				$result['token'] = $latest->token;
				$result['expired'] = $latest->expired;
			}
			return $result;

		}
	}
?>