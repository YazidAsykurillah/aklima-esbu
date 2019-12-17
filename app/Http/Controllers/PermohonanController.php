<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Permohonan;
use App\LogPermohonan;

class PermohonanController extends Controller
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

        \DB::statement(\DB::raw('set @rownum=0'));
        if($request->has('status') && $request->status !="all"){
            $permohonan = Permohonan::with(['jenis_usaha', 'badan_usaha', 'badan_usaha.bentuk_badan_usaha'])->select([
                \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'permohonan.*'
            ])->where('status', '=', $request->status);
        }else{
            $permohonan = Permohonan::with(['jenis_usaha', 'badan_usaha', 'badan_usaha.bentuk_badan_usaha'])->select([
                \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'permohonan.*'
            ]);
        }
        

        $data_permohonan =  Datatables::of($permohonan->get())
            ->addColumn('nama_jenis_usaha', function($permohonan){
                return $permohonan->jenis_usaha->nama_jenis_usaha;
            })
            ->addColumn('nama_badan_usaha', function($permohonan){
                $disp = '';
                $disp.= $permohonan->badan_usaha->nama_badan_usaha.'&nbsp;';
                $disp.= '('.$permohonan->badan_usaha->bentuk_badan_usaha->nama_singkat.')';
                $disp.= '<br/>';
                $disp.= $permohonan->badan_usaha->kota->provinsi->nama_provinsi;
                return $disp;
            })
            ->addColumn('alamat_badan_usaha', function($permohonan){
                return $permohonan->badan_usaha->alamat_badan_usaha;
            })
            ->editColumn('status', function($permohonan){
                return translate_status_permohonan($permohonan->status);
            })
            ->addColumn('actions', function($permohonan){
                $actions ='';
                if($permohonan->status == '0'){
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
        $log_permohonan = $permohonan->log_permohonan;
        return view('permohonan.show')
            ->with('permohonan', $permohonan)
            ->with('log_permohonan', $log_permohonan);
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
        return response()->json($permohonan->identitas_badan_usaha);
    }

    public function fetchPersyaratanAdministratif($uid_permohonan)
    {
        $permohonan = Permohonan::findOrFail($uid_permohonan);
        return response()->json($permohonan->persyaratan_administratif);
    }

    public function changeStatus(Request $request)
    {

        $original_status = $request->permohonan_original_status;
        $next_status = $request->permohonan_next_status;
        if($original_status == '0' && $next_status == '1'){
            return $this->call_api_proses_pendaftaran($request);
        }else{
            $permohonan = Permohonan::findOrFail($request->permohonan_id_to_change);
            $permohonan->status = $next_status;
            $permohonan->save();

            $this->insertLogPermohonan($request->permohonan_id_to_change, $original_status, $request->permohonan_next_status, $request->log_description);
            return redirect()->back()
                ->with('successMessage', "Status permohonan berhasil diubah");    
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
        $badan_usaha = $permohonan->badan_usaha;
        $jenis_usaha = $permohonan->jenis_usaha;
        $identitas_badan_usaha = $permohonan->identitas_badan_usaha;
        $persyaratan_administratif = $permohonan->persyaratan_administratif;

        $export_name = 'Permohonan-'.$permohonan->uid_permohonan.'.pdf';

        

        $data = [
            'permohonan' => $permohonan,
            'badan_usaha'=>$badan_usaha,
            'jenis_usaha'=>$jenis_usaha,
            'identitas_badan_usaha'=>$identitas_badan_usaha,
            'persyaratan_administratif'=>$persyaratan_administratif,
        ];

        $pdf = \PDF::loadView('permohonan.print_certificate', $data);


        return $pdf->stream($export_name);
    }
}
