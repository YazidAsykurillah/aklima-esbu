<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Permohonan;

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
            }
            elseif($status == 0){
                return view('permohonan.status_0')
                    ->with('status', $status);
            }
            elseif($status == 1){
                return view('permohonan.status_1')
                    ->with('status', $status);
            }
            elseif($status == 2){
                return view('permohonan.status_2')
                    ->with('status', $status);
            }
            elseif($status == 4){
                return view('permohonan.status_4')
                    ->with('status', $status);
            }
            elseif($status == 5){
                return view('permohonan.status_5')
                    ->with('status', $status);
            }
            elseif($status == 6){
                return view('permohonan.status_6')
                    ->with('status', $status);
            }
            elseif($status == 7){
                return view('permohonan.status_7')
                    ->with('status', $status);
            }
            elseif($status == 10){
                return view('permohonan.status_10')
                    ->with('status', $status);
            }
            elseif($status == 11){
                return view('permohonan.status_11')
                    ->with('status', $status);
            }
            elseif($status == 12){
                return view('permohonan.status_12')
                    ->with('status', $status);
            }
            elseif($status == 14){
                return view('permohonan.status_14')
                    ->with('status', $status);
            }
            else{
                return $status;
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
        

        return Datatables::eloquent($permohonan)
            ->addColumn('nama_jenis_usaha', function($permohonan){
                return $permohonan->jenis_usaha->nama_jenis_usaha;
            })
            ->addColumn('nama_badan_usaha', function($permohonan){
                return $permohonan->badan_usaha->nama_badan_usaha;
            })
            ->addColumn('bentuk_badan_usaha', function($permohonan){
                return $permohonan->badan_usaha->bentuk_badan_usaha->nama_bentuk_badan_usaha;
            })
            ->addColumn('alamat_badan_usaha', function($permohonan){
                return $permohonan->badan_usaha->alamat_badan_usaha;
            })
            ->editColumn('status', function($permohonan){
                return translate_status_permohonan($permohonan->status);
            })
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
     * @param  int  $uid_permohonan
     * @return \Illuminate\Http\Response
     */
    public function show($uid_permohonan)
    {
        $permohonan = Permohonan::findOrFail($uid_permohonan);
        return view('permohonan.show')
            ->with('permohonan', $permohonan);
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
        
        $permohonan = Permohonan::findOrFail($request->permohonan_id_to_change);
        $next_status = $request->permohonan_next_status;
        $permohonan->status = $next_status;
        $permohonan->save();
        return redirect()->back()
            ->with('successMessage', "Status permohonan berhasil diubah");
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
