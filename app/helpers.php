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

	if(!function_exists('translate_status_permohonan')){
		function translate_status_permohonan($status = NULL){
			$result = "-";
			switch ($status) {
				case '0':
					$result = "Menunggu Dokumen";
					break;
				case '1':
					$result = "Front Desk";
					break;
				case '2':
					$result = "Dokumen lengkap dan proses upload";
					break;
				case '4':
					$result = "Verifikator";
					break;
				case '5':
					$result = "Auditor";
					break;
				case '6':
					$result = "Validator";
					break;
				case '7':
					$result = "Evaluator";
					break;
				case '10':
					$result = "Top Approval";
					break;
				case '11':
					$result = "SBU Sudah diregistrasi";
					break;
				case '12':
					$result = "SBU Sudah dicetak";
					break;
				case '14':
					$result = "SBU Sudah diterima pemohon";
					break;
				default:
					$result = $status;
					break;
			}
			return $result;
		}
	}
?>