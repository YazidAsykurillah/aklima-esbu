<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\SubBidang;

class SubBidangController extends Controller
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
        $sub_bidang = SubBidang::with(['bidang', 'jenis_usaha'])->select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'sub_bidang.*',
        ])->get();

        $data_sub_bidang = Datatables::of($sub_bidang)
            ->addColumn('nama_bidang', function($sub_bidang){
                return $sub_bidang->bidang->nama_bidang;
            })
            ->addColumn('nama_jenis_usaha', function($sub_bidang){
                return $sub_bidang->jenis_usaha->nama_jenis_usaha;
            })
            ;

        if ($keyword = $request->get('search')['value']) {
            $data_sub_bidang->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $data_sub_bidang->make(true);
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
}
