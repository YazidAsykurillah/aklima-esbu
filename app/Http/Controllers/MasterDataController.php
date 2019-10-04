<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function bentukBadanUsaha(Request $request)
    {
    	return view('master-data.bentuk-badan-usaha');
    }
}
