<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\BentukBadanUsaha;
class BentukBadanUsahaController extends Controller
{
    public function dataTables(Request $request)
    {
        \DB::statement(\DB::raw('set @rownum=0'));
        $bentuk_badan_usaha = BentukBadanUsaha::select([
            \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'bentuk_badan_usahas.*',
        ])->get();

        $data_bentuk_badan_usaha = Datatables::of($bentuk_badan_usaha);

        if ($keyword = $request->get('search')['value']) {
            $data_bentuk_badan_usaha->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $data_bentuk_badan_usaha->make(true);
    }
}
