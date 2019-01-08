<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\layer;
use App\daerah;
use App\kategori;

class frontweb extends Controller
{
    public function loadlayer(Request $request)
    {
    	// DD($request);
    	if ($request->daerahs_id == "semua" && isset($request->kategori)) {
    		$data['layer'] = layer::join('daerahs','layers.daerahs_id','=','daerahs.id')
    					->select('layers.*','daerahs.id as id_daerah','daerahs.nama_daerah','daerahs.x','daerahs.y')
    					->whereIN('layers.kategoris_id',$request->kategori)
						->get();
    	} else {
    		$data['layer'] = layer::join('daerahs','layers.daerahs_id','=','daerahs.id')
    					->select('layers.*','daerahs.id as id_daerah','daerahs.nama_daerah','daerahs.x','daerahs.y')
    					->whereIN('layers.kategoris_id',$request->kategori)
    					->where('layers.daerahs_id',$request->daerahs_id)
						->get();
    	}
    	$data['daerah'] = daerah::find($request->daerahs_id);
    	return $data;
		// DD($layer);
    }
}
