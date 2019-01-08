<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tampilan;
use App\jaling;
use App\history_edit;
use App\kategori;
use App\data;
use App\daerah;

class tampilanController extends Controller
{

	public function index() {

		$data['datas'] = tampilan::first();
		// $data['datas']->$data = $data['datas']->tengah;

		// $str_data = (object) [
  //                       "zoom"=> 13,
  //                       "tilt"=> 0,
  //                       "mapTypeId"=> "hybrid",
  //                       "center"=> (object) [
  //                                       "lat"=> -0.02495003307871443,
  //                                       "lng"=> 109.34001852688061
  //                                   ],
  //                       "overlays"=> []
  //                   ];
  //       $data['str_data'] = json_encode($str_data);
		// $dataaa = (object) [
  //                       "zoom"=> 13,
  //                       "tilt"=> 0,
  //                       "mapTypeId"=> "hybrid",
  //                       "center"=> (object) [
  //                                       "lat"=> -0.02495003307871443,
  //                                       "lng"=> 109.34001852688061
  //                                   ],
  //                       "overlays"=> []
  //                   ];
  //       $data['datas']['tengah'] = json_encode($dataaa);

        return view('admin.tampilan',$data);
	    // return view('admin.tampilan',compact('datas'));

	}

    public function ubahData(Request $request)
    {
		$tampilan = tampilan::first();
		$tampilan->favicon = $request->favicon;
		$tampilan->logo_instansi = $request->logo_instansi;
		$tampilan->nama_instansi = $request->nama_instansi;
		$tampilan->logo_pem = $request->logo_pem;
		$tampilan->nama_pem = $request->nama_pem;
		$tampilan->logo_aplikasi = $request->logo_aplikasi;
		$tampilan->nama_aplikasi = $request->nama_aplikasi;
		$tampilan->site_title = $request->site_title;
		$tampilan->site_keyword = $request->site_keyword;
		$tampilan->site_desc = $request->site_desc;
		$tampilan->tentang = $request->tentang;
		$tampilan->tengah = $request->tengah;
		$tampilan->save();
		return redirect('/admin/tampilan');
    }

    public function data()
    {
		$tampilan = tampilan::first();
    	return $tampilan;
    }

    public function dashboard() {
    	// $data['datas'] = jaling::all();
    	$data['datas'] = jaling::whereIn('stats', ['new','updated'])->get();
    	$data['history'] = history_edit::orderBy('created_at', 'desc')->paginate(10);
    	$data['status'] = jaling::select('rencana')->whereIn('stats', ['new','updated'])->get()->groupBy('rencana');
    	// $data['status'] = jaling::select('status', DB::raw('count(*) as total'))->whereIn('stats', ['new','updated'])->get()->groupBy('rencana');
    	// ->paginate(10)
	    return view('admin.dashboard',$data);
	}

	public function filter(Request $request) {
		$kategoris = kategori::all();
		// $datas = data::all();
		$datas = jaling::whereIn('stats', ['new','updated'])->whereNotNull('data')->get();
		$daerah = daerah::all();
		$kecamatan = jaling::select('kecamatan')->whereIn('stats', ['new','updated'])->whereNotNull('data')->get()->groupBy('kecamatan');
		// $web = "F";
		// test
	    // $str_data = (object) [
	    //                 "zoom"=> 7,
	    //                 "tilt"=> 0,
	    //                 "mapTypeId"=> "hybrid",
	    //                 "center"=> (object) [
	    //                                 "lat"=> -0.0352232,
	    //                                 "lng"=> 109.2613377
	    //                             ],
	    //                 "overlays"=> []
	    //             ];
	    if($request->kecamatan != null) {   
	    	$data['jaling'] = jaling::select('data')->whereIn('kecamatan',$request->kecamatan)->whereIn('stats', ['new','updated'])->get();
		}
		else {
			$data['jaling'] = jaling::select('data')->where('kecamatan','ffafalknklnsavalk')->whereIn('stats', ['new','updated'])->get();
		}
		$array_kecamatan = $request->kecamatan;
	    
	    $tengah = tampilan::first();
	    $str_data = json_decode($tengah->tengah);
	    
	    	foreach ($data['jaling'] as $key => $value) {
		        if (!empty($value->data)) {
		            $new = json_decode($value->data);
		            foreach ($new->overlays as $i => $j) {
		                $str_data->overlays[] = $j;
		            }
		        }
		    }
	    
	    // if(!empty($data['jaling'])) {
	    	
	    // }
	    
	    // DD($str_data);
		    $data['str_data'] = json_encode($str_data);
		   //  $tengah = tampilan::first();
	    // $data['str_data'] = $tengah->tengah;
	    // $data['str_data'] = json_encode($str_data);
	    // DD($data);
	    // return view('admin.jaling.allmap',$data);	


	    return view('front.index')->with(compact('kategoris','datas','daerah','kecamatan','array_kecamatan'))->with($data);
	    // return view('front.index',compact('kategoris','datas','daerah'));
	}


	public function front(Request $request) {
		$kategoris = kategori::all();
		// $datas = data::all();
		$datas = jaling::whereIn('stats', ['new','updated'])->whereNotNull('data')->get();
		$daerah = daerah::all();
		$kecamatan = jaling::select('kecamatan')->whereIn('stats', ['new','updated'])->whereNotNull('data')->get()->groupBy('kecamatan');
		$web = "front";
		$web2 = array('web' => 'front');
		// test
	    // $str_data = (object) [
	    //                 "zoom"=> 7,
	    //                 "tilt"=> 0,
	    //                 "mapTypeId"=> "hybrid",
	    //                 "center"=> (object) [
	    //                                 "lat"=> -0.0352232,
	    //                                 "lng"=> 109.2613377
	    //                             ],
	    //                 "overlays"=> []
	    //             ];

	    $tengah = tampilan::first();
	    $str_data = json_decode($tengah->tengah);

		if (isset($req->kecamatan)) {
	            $data['jaling'] = jaling::select('data')->whereIn('kecamatan',$req->kecamatan)->whereIn('stats', ['new','updated'])->get();
	            // $data['jaling'] = jaling::where('kecamatan','like','%'.$req->kecamatan.'%')->get();
	    } else {
	    		$data['jaling'] = jaling::select('data')->whereIn('stats', ['new','updated'])->get();
	    }

		
	    $array_kecamatan = array();
	    foreach ($data['jaling'] as $key => $value) {
	        if (!empty($value->data)) {
	            $new = json_decode($value->data);
	            foreach ($new->overlays as $i => $j) {
	                $str_data->overlays[] = $j;
	            }
	        }
	    }
	    // DD($str_data);
	    // $tengah = tampilan::first();
	    // $data['str_data'] = $tengah->tengah;
	    $data['str_data'] = json_encode($str_data);
	    // DD($data);
	    // return view('admin.jaling.allmap',$data);	


	    return view('front.index')->with(compact('kategoris','datas','daerah','kecamatan','array_kecamatan','web'))->with($data);
	    // return view('front.index',compact('kategoris','datas','daerah'));
	}


	public function caristatus($id)
    {
        $data = jaling::where('rencana',$id)->whereIn('stats', ['new','updated'])->get();
        // $data = jaling::all();
        return $data;
    }
}
