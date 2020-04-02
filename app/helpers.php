<?php
	use Carbon\Carbon;
	
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
					$result = "Verifikasi Asesor TT";
					break;
				case '2':
					$result = "Dokumen lengkap dan proses upload";
					break;
				case '4':
					$result = "Verifikasi Asesor PJT";
					break;
				case '5':
					$result = "Verifikasi LSBU Pusat";
					break;
				case '6':
					$result = "Validator";
					break;
				case '7':
					$result = "DJK (Prepare)";
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
					$result = ucwords($status);
					break;
			}
			return ucwords($result);
		}
	}

	if(!function_exists('translate_log_from_to')){
		function translate_log_from_to($from_to){
			$result = "";
			switch ($from_to) {
				case '0-1':
					$result = "Dikirim ke Asesor TT";
					break;
				case '1-4':
					$result = "Dikirim ke Asesor PJT";
					break;
				case '4-5':
					$result = "Dikirim ke LSBU Pusat";
					break;
				case '4-1':
					$result = "Dikembalikan ke Asesor TT";
					break;
				case '5-7':
					$result = "Dikirim ke DJK (Prepare)";
					break;
				case '5-1':
					$result = "Dikembalikan ke Asesor TT";
					break;

				default:
					# code...
					break;
			}
			return $result;
		}
	}

	if(!function_exists('indonesian_date')){
		function indonesian_date($date = NULL){
			$output = NULL;
			if(is_null($date)){
				$output = NULL;
			}else{
				$indo_month = '';
				$year = Carbon::parse($date)->format('Y');
				$month = Carbon::parse($date)->format('m');
				switch ($month) {
					case '01':
						$indo_month = 'Januari';
						break;
					case '02':
						$indo_month = 'Februari';
						break;
					case '03':
						$indo_month = 'Maret';
						break;
					case '04':
						$indo_month = 'April';
						break;
					case '05':
						$indo_month = 'Mei';
						break;
					case '06':
						$indo_month = 'Juni';
						break;
					case '07':
						$indo_month = 'Juli';
						break;
					case '08':
						$indo_month = 'Agustus';
						break;
					case '09':
						$indo_month = 'September';
						break;
					case '10':
						$indo_month = 'Oktober';
						break;
					case '11':
						$indo_month = 'November';
						break;
					case '12':
						$indo_month = 'Desember';
						break;
					default:
						$indo_month = 'UNDEFINED';
						break;
				}
				$date = Carbon::parse($date)->format('d');
				
				$output = $date.' '.$indo_month.' '.$year;
			}
			return $output;
		}
	}

	if(!function_exists('rupiah')){
		function rupiah($input = NULL){
			$output = 0;
			if(!is_null($input)){
				$output = number_format($input,0,',','.');
			}
			return $output;
		}
	}

	if(!function_exists('translate_jenis_sertifikasi')){
		function translate_jenis_sertifikasi($value = NULL){
			$output = "";
			if(!is_null($value)){
				switch ($value) {
					case '1':
						$output = "Baru";
						break;
					case '2':
						$output = "Perpanjangan";
						break;
					case '3':
						$output = "Perubahan";
						break;
					default:
						# code...
						break;
				}
			}
			return $output;
		}
	}

?>