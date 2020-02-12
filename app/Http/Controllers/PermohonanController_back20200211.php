<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Permohonan;
use App\Asesor;
use App\AsesorPermohonan;
use App\LsbuWilayah;
use App\LogPermohonan;
use App\Sertifikat;

use Event;
use App\Events\PermohonanIsDisplayed;

class PermohonanController_back20200211 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->has('status')){
            $status = $request->status;
            if($status == "all"){
                return view('permohonan.status_all')
                    ->with('status', $status);
            }else{
                return view('permohonan.index')
                ->with('status', $status);    
            }
            
        }else{
            return 'missing status';
        }
    }

    public function datatables(Request $request)
    {
        //return $request->all();
        $user = \Auth::user();
        //get asesor id if the user is asesor;
        $asesor_id = NULL;
        if($user->is_asesor == TRUE){
            $asesor_id = $user->asesor->uid_asesor;
        }

        //get dpd id = 
        $provinsi_id = $user->provinsi_id;
        //return $provinsi_id;


        \DB::statement(\DB::raw('set @rownum=0'));
        if($request->has('status') && $request->status !="all"){
            $permohonan = Permohonan::with(['jenis_usaha', 'badan_usaha', 'badan_usaha.bentuk_badan_usaha', 'badan_usaha.kota.provinsi', 'asesor_tenaga_teknik', 'asesor_penanggung_jawab_teknik'])
            ->select([
                \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'permohonan.*'
            ])
            ->where('status', '=', $request->status)
            ->where('is_processed', '=', $request->is_processed)
            ->where('badan_usaha_uid','!=', NULL);

            if($request->status == '1' && \Auth::user()->is_asesor == TRUE){
                $permohonan->where('asesor_tt_id', '=', $asesor_id);
            }
            if($request->status == '4' && \Auth::user()->is_asesor == TRUE){
                $permohonan->where('asesor_pjt_id', '=', $asesor_id);
            }

            if($provinsi_id!=NULL){
                $permohonan->whereHas('badan_usaha.kota.provinsi', function($query) use($provinsi_id){
                    return $query->where('uid_provinsi','=', $provinsi_id);
                });
            }

        }else{
            $permohonan = Permohonan::with(['jenis_usaha', 'badan_usaha', 'badan_usaha.bentuk_badan_usaha', 'badan_usaha.kota.provinsi', 'asesor_tenaga_teknik', 'asesor_penanggung_jawab_teknik'])
            ->select([
                \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'permohonan.*'
            ])
            ->where('status', '!=', '14')
            ->where('badan_usaha_uid','!=', NULL);
            if($provinsi_id!=NULL){
                $permohonan->whereHas('badan_usaha.kota.provinsi', function($query) use($provinsi_id){
                    return $query->where('uid_provinsi','=', $provinsi_id);
                });
            }
        }
        

        $data_permohonan =  Datatables::of($permohonan->get())
            ->addColumn('nama_jenis_usaha', function($permohonan){
                return $permohonan->jenis_usaha->nama_jenis_usaha;
            })
            ->addColumn('nama_badan_usaha', function($permohonan){
                $disp = '';
                $disp.= $permohonan->badan_usaha->nama_badan_usaha.'&nbsp;';
                $disp.= '('.$permohonan->badan_usaha->bentuk_badan_usaha->nama_singkat.')';
                return $disp;
            })
            ->addColumn('provinsi_badan_usaha', function($permohonan) use($provinsi_id){
                return $permohonan->badan_usaha->kota->provinsi->nama_provinsi;
            })
            ->addColumn('alamat_badan_usaha', function($permohonan){
                return $permohonan->badan_usaha->alamat_badan_usaha;
            })
            ->editColumn('is_processed', function($permohonan){
                $is_processed = '';
                if($permohonan->is_processed == FALSE){
                    $is_processed.='<p>Belum diproses</p>';
                    $is_processed.='<button class="btn btn-primary btn-xs btn-set-is-processed" data-uid-permohonan="'.$permohonan->uid_permohonan.'">';
                    $is_processed.= '<i class="fa fa-check-circle"></i>';
                    $is_processed.='</button>';
                }else{
                    $is_processed.='<p>Sudah diproses</p>';
                }
                return $is_processed;
            })
            ->editColumn('status', function($permohonan){
                return translate_status_permohonan($permohonan->status);
            })
            ->editColumn('asesor_tt_id', function($permohonan){
                $disp_asesor_tt = '';
                if($permohonan->asesor_tenaga_teknik){
                    $disp_asesor_tt.= $permohonan->asesor_tenaga_teknik->nama_asesor.'<br/>';
                    /*if($permohonan->status == '0'){
                        $disp_asesor_tt.= '<button class="btn btn-danger btn-xs btn-delete-asesor-tt" data-uid-permohonan-asesor="'.$permohonan->uid_permohonan_tt.'">';
                        $disp_asesor_tt.=   '<i class="fa fa-trash"></i>';
                        $disp_asesor_tt.= '</button>';
                    }*/
                }else{
                    /*if($permohonan->status == '0'){
                        $disp_asesor_tt.='<button class="btn btn-info btn-xs btn-add-asesor-tt" data-uid-permohonan="'.$permohonan->uid_permohonan.'" data-provinsi-id="'.$permohonan->badan_usaha->kota->provinsi_uid.'">';
                        $disp_asesor_tt.=   '<i class="fa fa-plus-circle"></i>';
                        $disp_asesor_tt.='</button>';
                    }*/
                    
                }
                return $disp_asesor_tt;

            })
             ->editColumn('asesor_pjt_id', function($permohonan){
                $disp_asesor_pjt = '';
                if($permohonan->asesor_penanggung_jawab_teknik){
                    $disp_asesor_pjt.= $permohonan->asesor_penanggung_jawab_teknik->nama_asesor.'<br/>';
                    /*if($permohonan->status == '0'){
                        $disp_asesor_pjt.= '<button class="btn btn-danger btn-xs btn-delete-asesor-pjt" data-uid-permohonan-asesor="'.$permohonan->uid_permohonan_pjt.'">';
                        $disp_asesor_pjt.=   '<i class="fa fa-trash"></i>';
                        $disp_asesor_pjt.= '</button>';
                    }*/
                }else{
                    /*if($permohonan->status == '0'){
                        $disp_asesor_pjt.='<button class="btn btn-info btn-xs btn-add-asesor-pjt" data-uid-permohonan="'.$permohonan->uid_permohonan.'" data-provinsi-id="'.$permohonan->badan_usaha->kota->provinsi_uid.'">';
                        $disp_asesor_pjt.=   '<i class="fa fa-plus-circle"></i>';
                        $disp_asesor_pjt.='</button>';
                    }*/
                }
                return $disp_asesor_pjt;

            })
            ->addColumn('actions', function($permohonan){
                $actions ='';
                if($permohonan->status == '0' && $permohonan->asesor_tt_id != NULL && $permohonan->asesor_pjt_id != NULL){
                    $actions.='<button class="btn btn-primary btn-change-status btn-xs" title="Kirim ke Frontdesk" data-original-status="0" data-next-status="1" data-uid-permohonan="'.$permohonan->uid_permohonan.'">';
                    $actions.=  '<i class="fa fa-share-square"></i>';
                    $actions.='</button>';
                }
                return $actions;
            });
        if ($keyword = $request->get('search')['value']) {
            $data_permohonan->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $data_permohonan->make(true);
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
     * @param  int  $uid_permohonan
     * @return \Illuminate\Http\Response
     */
    public function show($uid_permohonan)
    {
        $permohonan = Permohonan::findOrFail($uid_permohonan);
        $identitas_badan_usaha = $permohonan->identitas_badan_usaha;
        $persyaratan_administratif = $permohonan->persyaratan_administratif;
        $persyaratan_teknis = $permohonan->persyaratan_teknis;
        $data_pengurus_dewan_komisaris = $permohonan->data_pengurus_dewan_komisaris;
        $data_pengurus_dewan_direksi = $permohonan->data_pengurus_dewan_direksi;
        $data_pengurus_pemegang_saham = $permohonan->data_pengurus_pemegang_saham;
        $sertifikat = $permohonan->sertifikat;
        $log_permohonan = $permohonan->log_permohonan;
        $akta_perubahan_bu_pa = $permohonan->akta_perubahan_bu_pa;
        $pengesahan_akta_perubahan = $permohonan->pengesahan_akta_perubahan;
        
        //Fire event PermohonanIsDisplayed
        Event::fire(new PermohonanIsDisplayed($permohonan));

        $status_djk = $permohonan->status_djk;
        //return $status_djk;

        return view('permohonan.show')
            ->with('permohonan', $permohonan)
            ->with('identitas_badan_usaha', $identitas_badan_usaha)
            ->with('persyaratan_administratif', $persyaratan_administratif)
            ->with('persyaratan_teknis', $persyaratan_teknis)
            ->with('data_pengurus_dewan_komisaris', $data_pengurus_dewan_komisaris)
            ->with('data_pengurus_dewan_direksi', $data_pengurus_dewan_direksi)
            ->with('data_pengurus_pemegang_saham', $data_pengurus_pemegang_saham)
            ->with('log_permohonan', $log_permohonan)
            ->with('akta_perubahan_bu_pa', $akta_perubahan_bu_pa)
            ->with('pengesahan_akta_perubahan', $pengesahan_akta_perubahan)
            ->with('sertifikat', $sertifikat)
            ->with('status_djk', $status_djk);
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

    public function getIdentitasBadanUsaha($uid_permohonan)
    {
        $permohonan = Permohonan::findOrFail($uid_permohonan);
        return response()->json(
            ['data'=>$permohonan->identitas_badan_usaha]
        );
    }

    public function fetchPersyaratanAdministratif($uid_permohonan)
    {
        $permohonan = Permohonan::findOrFail($uid_permohonan);
        return response()->json(
            ['data'=>$permohonan->persyaratan_administratif]
        );
    }


    public function changeStatus(Request $request)
    {

        $original_status = $request->permohonan_original_status;
        $next_status = $request->permohonan_next_status;
        //return $request->all();
        //Menunggu Dokumen ke Frontdesk (Asesor TT)
        if($original_status == '0' && $next_status == '1'){
            return $this->call_api_kirim_ke_asesor_tt($request);
        }
        else{
            $permohonan = Permohonan::findOrFail($request->permohonan_id_to_change);
            $permohonan->status = $next_status;
            $permohonan->save();

            $this->insertLogPermohonan($request->permohonan_id_to_change, $original_status, $request->permohonan_next_status, $request->log_description);
            return redirect()->back()
                ->with('successMessage', "Status permohonan berhasil diubah");    
        }
        
    }

    

    protected function call_api_kirim_ke_asesor_tt($request){
        
        try{
            $token = getCurrentActiveToken()['token'];
            $original_status = $request->permohonan_original_status;
            $next_status = $request->permohonan_next_status;

            $permohonan = Permohonan::findOrFail($request->permohonan_id_to_change);

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Kirim-Data-Pemohon-Ke-Asesor');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);
            
            $permohonan->status = $next_status;
            $permohonan->save();

            $this->insertLogPermohonan($request->permohonan_id_to_change, $original_status, $request->permohonan_next_status, $request->log_description);
            
            return redirect()->back()
                ->with('successMessage', $decode->message);            
        }
        catch(Exception $e){
            return $e;
        }
    }

    protected function call_api_proses_pendaftaran($request)
    {
           
        try{
            $token = getCurrentActiveToken()['token'];
            $original_status = $request->permohonan_original_status;
            $next_status = $request->permohonan_next_status;

            $permohonan = Permohonan::findOrFail($request->permohonan_id_to_change);

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Pendaftaran/Proses');
            
            $permohonan->status = $next_status;
            $permohonan->save();

            $this->insertLogPermohonan($request->permohonan_id_to_change, $original_status, $request->permohonan_next_status, $request->log_description);
            
            return redirect()->back()
                ->with('successMessage', "Status permohonan berhasil diubah");            
        }
        catch(Exception $e){
            return $e;
        }
    }


    public function saveAsesorTT(Request $request)
    {
        // return $request->all();
        try{
            $token = getCurrentActiveToken()['token'];
            //Check Permohonan
            $permohonan = Permohonan::findOrFail($request->uid_permohonan_to_add_asesor_tt);

            //Check Asesor
            $asesor = Asesor::findOrFail($request->asesor_tt_id);

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_permohonan' => $permohonan->uid_permohonan,
                    'uid_asesor'=>$asesor->uid_asesor,
                    'peran'=>$request->peran
                ]
            ]);
            $response = $client->post('Service/Permohonan/Asesor-TT/Tambah');
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            //get uid_permohonan_asesor from response;
            $uid_permohonan_asesor = $decode->uid_permohonan_asesor;
            
            //update asseor_tt_id property of Permohonan;
            $permohonan->asesor_tt_id = $asesor->uid_asesor;
            $permohonan->save();


            //insert data to asesor_permohonan table
            $data_asesor_permohonan = [
                'type'=>'tt',
                'uid_permohonan'=>$permohonan->uid_permohonan,
                'uid_asesor'=>$asesor->uid_asesor,
                'uid_permohonan_asesor'=>$uid_permohonan_asesor
            ];
            \DB::table('asesor_permohonan')->insert($data_asesor_permohonan);
            

            return redirect()->back()
                ->with('successMessage', "Data Asesor TT berhasil ditambahkan");            
        }
        catch(Exception $e){
            return $e;
        }
    }

    //Delete Asesor TT
    public function deleteAsesorTT(Request $request)
    {
        

        try{
            $token = getCurrentActiveToken()['token'];
            $asesor_permohonan = AsesorPermohonan::findOrFail($request->uid_permohonan_asesor_tt);

            //Check Permohonan
            $permohonan = Permohonan::findOrFail($asesor_permohonan->uid_permohonan);


            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_permohonan_asesor' => $asesor_permohonan->uid_permohonan_asesor,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Asesor-TT/Hapus');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            //Delete Asesor Permohonan
            $asesor_permohonan->delete();

            //RESET asesor_tt_id of permohonan to NULL;
            $permohonan->asesor_tt_id = NULL;
            $permohonan->save();

            return redirect()->back()
                ->with('successMessage', "Data Asesor TT berhasil dihapus");            
        }
        catch(Exception $e){
            return $e;
        }

    }

    protected function insertLogPermohonan($uid_permohonan, $original_status, $next_status, $description=NULL)
    {
        $logPermohonan = new LogPermohonan;
        $logPermohonan->uid_permohonan = $uid_permohonan;
        $logPermohonan->from_to = $original_status.'-'.$next_status;
        $logPermohonan->description = $description;
        $logPermohonan->save();
    }

    public function printCertificate(Request $request, $uid_permohonan)
    {
        $permohonan = Permohonan::findOrFail($uid_permohonan);
        $sertifikat = $permohonan->sertifikat;
        $badan_usaha = $permohonan->badan_usaha;
        $jenis_usaha = $permohonan->jenis_usaha;
        $identitas_badan_usaha = $permohonan->identitas_badan_usaha;
        $persyaratan_administratif = $permohonan->persyaratan_administratif;
        $persyaratan_teknis = $permohonan->persyaratan_teknis;

        $export_name = 'Permohonan-'.$permohonan->uid_permohonan.'.pdf';

        $tanggal_cetak = Carbon::now()->format('d-M-Y');
        

        $data = [
            'permohonan' => $permohonan,
            'badan_usaha'=>$badan_usaha,
            'jenis_usaha'=>$jenis_usaha,
            'identitas_badan_usaha'=>$identitas_badan_usaha,
            'persyaratan_administratif'=>$persyaratan_administratif,
            'persyaratan_teknis'=>$persyaratan_teknis,
            'tanggal_cetak'=>$tanggal_cetak
        ];

        $pdf = \PDF::loadView('permohonan.print_certificate', $data);


        return $pdf->stream($export_name);
    }


    public function saveAsesorPJT(Request $request)
    {
        try{
            $token = getCurrentActiveToken()['token'];
            //Check Permohonan
            $permohonan = Permohonan::findOrFail($request->uid_permohonan_to_add_asesor_pjt);

            //Check Asesor
            $asesor = Asesor::findOrFail($request->asesor_pjt_id);

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_permohonan' => $permohonan->uid_permohonan,
                    'uid_asesor'=>$asesor->uid_asesor,
                    'peran'=>$request->peran
                ]
            ]);
            $response = $client->post('Service/Permohonan/Asesor-PJT/Tambah');
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            //get uid_permohonan_asesor from response;
            $uid_permohonan_asesor = $decode->uid_permohonan_asesor;
            
            //update asesor_pjt_id property of Permohonan;
            $permohonan->asesor_pjt_id = $asesor->uid_asesor;
            $permohonan->save();


            //insert data to asesor_permohonan table
            $data_asesor_permohonan = [
                'type'=>'pjt',
                'uid_permohonan'=>$permohonan->uid_permohonan,
                'uid_asesor'=>$asesor->uid_asesor,
                'uid_permohonan_asesor'=>$uid_permohonan_asesor
            ];
            \DB::table('asesor_permohonan')->insert($data_asesor_permohonan);
            

            return redirect()->back()
                ->with('successMessage', "Data Asesor PJT berhasil ditambahkan");            
        }
        catch(Exception $e){
            return $e;
        }
    }

    //Delete Asesor PJT
    public function deleteAsesorPJT(Request $request)
    {
        //return $request->all();
        try{
            $token = getCurrentActiveToken()['token'];
            $asesor_permohonan = AsesorPermohonan::findOrFail($request->uid_permohonan_asesor_pjt);

            //Check Permohonan
            $permohonan = Permohonan::findOrFail($asesor_permohonan->uid_permohonan);


            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_permohonan_asesor' => $asesor_permohonan->uid_permohonan_asesor,
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Permohonan/Asesor-PJT/Hapus');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            //Delete Asesor Permohonan
            $asesor_permohonan->delete();

            //RESET asesor_pjt_id of permohonan to NULL;
            $permohonan->asesor_pjt_id = NULL;
            $permohonan->save();

            return redirect()->back()
                ->with('successMessage', "Data Asesor PJT berhasil dihapus");            
        }
        catch(Exception $e){
            return $e;
        }
    }


    public function setIsProcessed(Request $request)
    {
        
        try{
            $token = getCurrentActiveToken()['token'];

            $permohonan = Permohonan::findOrFail($request->uid_permohonan);

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> $token
                ],
                'form_params' => [
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Pendaftaran/Proses');
            
            $permohonan->is_processed = TRUE;
            $permohonan->save();
            
            return redirect()->back()
            ->with('successMessage', "Permohonan berhasil diproses");         
        }
        catch(Exception $e){
            return $e;
        }
    }


    public function generateNomorAgenda(Request $request)
    {
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;
        
        try{
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> getCurrentActiveToken()['token']
                ],
                'form_params' => [
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Generate-Nomor-Agenda');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                
            }
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            $ajaxResponse['result'] = $decode->result;
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
        }
        return $ajaxResponse;
    }


    public function tarikNomorSertifikat(Request $request)
    {
        $permohonan = Permohonan::findOrFail($request->uid_permohonan);
        $ajaxResponse['response']= NULL;
        $ajaxResponse['message']= NULL;
        $ajaxResponse['result']= NULL;
        
        try{
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => config('app.gatrik_base_uri'),
                'verify'=>false,
                'headers'=>[
                    'Content-Type'=>'multipart/form-data',
                    'Enctype'=>'multipart/form-data',
                    'X-Lsbu-Key'=>config('app.x_lsbu_key'),
                    'Token'=> getCurrentActiveToken()['token']
                ],
                'form_params' => [
                    'uid_permohonan' => $permohonan->uid_permohonan,
                ]
            ]);
            $response = $client->post('Service/Tarik-Status-Permohonan');
            $code = $response->getStatusCode(); // 200
            $body = $response->getBody();
            $contents = $body->getContents();
            $decode = json_decode($contents);

            
            if($decode->response == '1'){
                
            }
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
            
        }
        catch(GuzzleException $e){
            $contents = $e->getResponse()->getBody()->getContents();
            $decode = json_decode($contents);
            $ajaxResponse['response'] = $decode->response;
            $ajaxResponse['message'] = $decode->message;
        }
        return $ajaxResponse;
    }

}
