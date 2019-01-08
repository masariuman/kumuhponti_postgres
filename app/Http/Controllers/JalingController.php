<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jaling;
use App\daerah;
use Excel;
use App\User;
use App\history_edit;
use App\tampilan;

class JalingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if (isset($req->kecamatan)) {
            $data['datas'] = jaling::where('kecamatan','like','%'.$req->kecamatan.'%')->whereIn('stats', ['new','updated']) ->get();
        } else {
            $data['datas'] = jaling::whereIn('stats', ['new','updated'])->get();
        }
        $data['user'] = User::all();
        $data['history'] = history_edit::all()->sortByDesc('created_at')->unique('kumuh_id');
        $data['daerah'] = daerah::all();
        $data['kecamatan'] = jaling::select('kecamatan')->whereIn('stats', ['new','updated'])->get()->groupBy('kecamatan');
        // DD($data);
        return view('admin.jaling.index',$data);
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
        // DD($request);
        $data = jaling::find($request->id);
        $data->update($request->all());
        // $data->data = $request->data;
        $data->stats = 'updated';
            $data->luas = $request->luas;
        $data->save();


        $history = new history_edit;
        $history->kumuh_id  = $data->id;
        $history->user_id   = $data->user_id;
        $history->lokasi    = $data->nama_lokasi;
        $history->kecamatan = $data->kecamatan;
        $history->kelurahan = $data->lokasi_keg;
        $history->status    = $data->rencana;
        $history->luas      = $data->luas;
        if ($request->catatan === null) {
            $history->catatan = "Tidak Ada Catatan";
        } else {
            $history->catatan   = $request->catatan;
        }
        $history->stats     = 'updated';
        $history->kategori_update = "Data Digitasi";
        $history->data      = $data->data;
        $history->created_at= date('Y-m-d H:i:s', strtotime("+7 hours"));
        $history->updated_at= date('Y-m-d H:i:s', strtotime("+7 hours"));

        $history->save();


        return redirect()->route('kumuh.index')->with('success','Koordinat Telah ditambahkan.');
        // return redirect()->back()->with('success','Koordinat Telah ditambahkan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$data['tengah'] = tampilan::first();

        $data['data'] = jaling::find($id);

        $data['original'] = history_edit::where('stats','new')->where('kumuh_id', $id)->get();

        $data['user'] = User::all();
        return view('admin.jaling.show',$data);
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

    public function import(Request $request)
    {
        $arr = [];
        $arr2 =[];
        if ( $request->hasfile('data') ) {

            $old = jaling::where('stats','new')->get();
            foreach ($old as $history_old) {
                $lama = jaling::find($history_old->id);
                $lama->stats     = 'updated';
                $lama->updated_at= date('Y-m-d H:i:s', strtotime("+7 hours"));
                $lama->Save();
            }



            $data = Excel::load($request->data)->get();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $arr[] = [
                                'nama_lokasi'=>$value->lokasi,
                                'lokasi_keg'=>$value->kelurahan,
                                'kecamatan'=>$value->kecamatan,
                                'rencana'=>$value->status,
                                'stats'=>'new',
                                'user_id'=>$request->user_id,
                                'created_at' => date('Y-m-d H:i:s', strtotime("+7 hours")),
                                'updated_at' => date('Y-m-d H:i:s', strtotime("+7 hours"))
                                // 'wilayah_id'=>$request->wilayah_id
                            ];
                }

                // if ( (!isset($arr['nama_lokasi']) && $arr['nama_lokasi'] === null) || (!isset($arr['lokasi_keg']) && $arr['lokasi_keg'] === null) || (!isset($arr['kecamatan']) && $arr['kecamatan'] === null) || (!isset($arr['rencana']) && $arr['rencana'] === null) ) {

                // if ( array_key_exists('nama_lokasi', $arr) || array_key_exists('lokasi_keg', $arr) || array_key_exists('kecamatan', $arr) || array_key_exists('rencana', $arr) ) {  
                $indexarr = 0;  
                foreach ($arr as $kosong) {
                	# code...
                	if (in_array(null, $arr[$indexarr])) {            	
	                	// kalau ada kosong
	                	session(['message' => 'gagalimport']);
	            		return redirect()->action('JalingController@index');
	                }
	                $indexarr += 1;
                }
                
                // else {
               //  	if ( ($arr['nama_lokasi'] === null || $arr['nama_lokasi'] === '') || ($arr['lokasi_keg'] === null || $arr['lokasi_keg'] === '') || ($arr['kecamatan'] === null || arr['kecamatan'] === '') || ($arr['rencana'] === null || $arr['rencana'] === '') ) { 
               //  		session(['message' => 'gagalimportkosong']);
            			// return redirect()->action('JalingController@index');
               //  	}
               //  	else {
                		jaling::insert($arr);

		                $kumuh = jaling::where('stats','new')->get();


		                foreach ($kumuh as $history_new) {
		                //     $arr2[] = [
		                //         // 'kumuh_id'=>$history_new->id,
		                //         'lokasi'=>$history_new->nama_lokasi,
		                //         'kecamatan'=>$history_new->kecamatan,
		                //         'kelurahan'=>$history_new->lokasi_keg,
		                //         'status'=>$history_new->rencana,
		                //         'catatan'=>'Data Baru',
		                //         'stats'=>'new',
		                //         'created_at'=> date('Y-m-d H:i:s'),
		                //         'updated_at'=> date('Y-m-d H:i:s')
		                //     ];
		                    $history = new history_edit;
		                    $history->kumuh_id  = $history_new->id;
		                    $history->user_id   = $request->user_id;
		                    $history->lokasi    = $history_new->nama_lokasi;
		                    $history->kecamatan = $history_new->kecamatan;
		                    $history->kelurahan = $history_new->lokasi_keg;
		                    $history->status    = $history_new->rencana;
		                    $history->catatan   = 'Data Baru';
		                    $history->stats     = 'new';
		                    $history->created_at= date('Y-m-d H:i:s', strtotime("+7 hours"));
		                    $history->updated_at= date('Y-m-d H:i:s', strtotime("+7 hours"));
		                    $history->save();

		                }

		                // $user = new history_edit;
		                // $user->catatan = 'test';
		                // $user->save();

		                // history_edit::insert($arr2);


		                // $history = new history_edit;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ;
		                // $history->kumuh_id = ; 
		                return redirect()->back();
                	// }
                	
                // }
                
            }
        }
    }


    public function Export(){
        Excel::create('Data', function($excel) {

            $excel->sheet('Sheet 1', function($sheet) {

                   
                    
                    $products=jaling::whereIn('stats', ['new','updated'])->get();;

                    // $products=DB::table('log_patrols')
                    // ->join("cms_companies","cms_companies.id","=","log_patrols.id_cms_companies")
                    // ->join("securities","securities.id","=","log_patrols.id_securities")
                    // ->select("log_patrols.*","cms_companies.name as nama_companies","securities.name as nama_security")
                    // ->get();

                        foreach($products as $product) {
                         $data[] = array(
                            $product->nama_lokasi,
                            $product->lokasi_keg,
                            $product->kecamatan,
                            $product->rencana,
                        );
                    }
                    // $sheet->fromArray($data);
                    $sheet->fromArray($data, null, 'A1', false, false);

                    $headings = array('Lokasi', 'Kecamatan', 'Kelurahan', 'Status');
                    $sheet->prependRow(1, $headings);
            });
    })->export('xls');
    }


    public function show_all(Request $req)
    {
        // $str_data = (object) [
        //                 "zoom"=> 13,
        //                 "tilt"=> 0,
        //                 "mapTypeId"=> "hybrid",
        //                 "center"=> (object) [
        //                                 "lat"=> -0.02495003307871443,
        //                                 "lng"=> 109.34001852688061
        //                             ],
        //                 "overlays"=> []
        //             ];


    	$tengah = tampilan::first();
	    $str_data = json_decode($tengah->tengah);

        if (isset($req->kecamatan)) {
            $data['jaling'] = jaling::select('data')->where('kecamatan','like','%'.$req->kecamatan.'%')->whereIn('stats', ['new','updated'])->get();
            // $data['jaling'] = jaling::where('kecamatan','like','%'.$req->kecamatan.'%')->get();
        }
        else {
            // $data['jaling'] = jaling::all()->where('kecamatan','like','%'.'PONTIANAK TIMUR'.'%')->select('data')->get();
            $data['jaling'] = jaling::select('data')->whereIn('stats', ['new','updated'])->get();
        }
            foreach ($data['jaling'] as $key => $value) {
                if (!empty($value->data)) {
                    $new = json_decode($value->data);
                    foreach ($new->overlays as $i => $j) {
                        $str_data->overlays[] = $j;
                    }
                }
            }
        // DD($str_data);
        $data['str_data'] = json_encode($str_data);




        // if (isset($req->kecamatan)) {
        //     $data['datas'] = jaling::where('kecamatan','like','%'.$req->kecamatan.'%')->whereIn('stats', ['new','updated'])->get();
        // } else {
        //     $data['datas'] = jaling::whereIn('stats', ['new','updated'])->get();
        // }
        $data['user'] = User::all();
        $data['daerah'] = daerah::all();
        $data['kecamatan'] = jaling::select('kecamatan')->whereIn('stats', ['new','updated'])->get()->groupBy('kecamatan');



        // DD($data);
        return view('admin.jaling.allmap',$data);
    }






    public function carikumuh($id)
    {
        $data = jaling::find($id);
        return $data;
    }

    public function hapusData(Request $request)
    {
            $user = Jaling::find($request->id);
        try {
            $user->delete();
            session(['message' => 'sukses']);
            return redirect()->action('JalingController@index');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect()->action('JalingController@index');
        }
    }

    public function ubahData(Request $request)
    {
            $user = Jaling::find($request->id);
            $user->nama_lokasi = $request->nama_lokasi;
            $user->kecamatan = $request->kecamatan;
            $user->lokasi_keg = $request->lokasi_keg;
            $user->rencana = $request->rencana;
            $user->stats = 'updated';
            $user->user_id   = $request->user_id;

            $history = new history_edit;
            $history->kumuh_id  = $user->id;
            $history->user_id   = $request->user_id;
            $history->lokasi    = $request->nama_lokasi;
            $history->kecamatan = $request->kecamatan;
            $history->kelurahan = $request->lokasi_keg;
            $history->status    = $request->rencana;
            $history->luas      = $request->luas;
            if ($request->catatan === null) {
            $history->catatan = "Tidak Ada Catatan";
            } else {
                $history->catatan   = $request->catatan;
            }
            $history->stats     = 'updated';
            $history->kategori_update = "Data Tarbulasi";
            $history->data      = $user->data;
            $history->created_at= date('Y-m-d H:i:s', strtotime("+7 hours"));
            $history->updated_at= date('Y-m-d H:i:s', strtotime("+7 hours"));

            
        try {
            $user->save();
            $history->save();
            session(['message' => 'sukses']);
            return redirect()->action('JalingController@index');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect()->action('JalingController@index');
        }
    }





    public function hapus(Request $request)
    {
            $user = Jaling::find($request->id);
            $user->stats = 'deleted';
            $user->user_id   = $request->user_id;

            $history = new history_edit;
            $history->kumuh_id  = $user->id;
            $history->user_id   = $request->user_id;
            $history->lokasi    = $user->nama_lokasi;
            $history->kecamatan = $user->kecamatan;
            $history->kelurahan = $user->lokasi_keg;
            $history->status    = $user->rencana;
            if ($request->catatan === null) {
            $history->catatan = "Tidak Ada Catatan";
            } else {
                $history->catatan   = $request->catatan;
            }
            $history->stats     = 'deleted';
            $history->data      = $user->data;
            $history->created_at= date('Y-m-d H:i:s', strtotime("+7 hours"));
            $history->updated_at= date('Y-m-d H:i:s');

            
        try {
            $user->save();
            $history->save();
            session(['message' => 'sukses']);
            return redirect()->action('JalingController@index');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect()->action('JalingController@index');
        }
    }




    public function carihistory($id)
    {   
        // $data = jaling::find($id);
        // $data = history_edit::where('kumuh_id',$id)->orderBy('created_at', 'DESC')->get();
        // $data = history_edit::with('User')->where('kumuh_id',$id)->orderBy('created_at', 'DESC')->paginate(5);
        $data = history_edit::orderBy('created_at', 'DESC')->where('kumuh_id',$id)->take(5)->get();
        // $data = history_edit::orderBy('created_at', 'desc')->where('kumuh_id',$id)->paginate(5);

        return $data;
    }


    public function all_history($id)
    {   
        // $data = jaling::find($id);
        // $data = history_edit::where('kumuh_id',$id)->orderBy('created_at', 'DESC')->get();
        // $data = history_edit::with('User')->where('kumuh_id',$id)->orderBy('created_at', 'DESC')->paginate(5);
        // $data = history_edit::orderBy('created_at', 'DESC')->where('kumuh_id',$id)->take(5)->get();
        // $data = history_edit::orderBy('created_at', 'desc')->where('kumuh_id',$id)->paginate(5);

         $data['datas'] = history_edit::orderBy('created_at', 'DESC')->where('kumuh_id',$id)->get(); 

        return view('admin.all_history',$data);
    }

    public function all_history_show($id)
    {
        $data['data'] = history_edit::find($id);

        $data['original'] = history_edit::where('stats','new')->where('kumuh_id', $data['data']->kumuh_id)->get();

        $data['user'] = User::all();
        return view('admin.all_history_show',$data);
    }

    public function history_restore(Request $request)
    {
        // DD($request);
        $data = history_edit::find($request->id);
        $time = $data->created_at->format('d F Y');
        $time2 = $data->created_at->format('H:i:s');
        $kumuhid = $data->kumuh_id;
        $jaling = Jaling::where('id',$kumuhid)->get()->first();
        $jaling->nama_lokasi    = $data->lokasi;
        $jaling->lokasi_keg     = $data->kelurahan;
        $jaling->Kecamatan      = $data->kecamatan;
        $jaling->rencana        = $data->status;
        $jaling->luas           = $data->luas;
        $jaling->data           = $data->data;
        $jaling->stats          = 'updated';
        $jaling->user_id        = $request->user_id;
        $jaling->updated_at     = date('Y-m-d H:i:s', strtotime("+7 hours"));
        // $data->update($request->all());
        // $data->data = $request->data;
        // $data->stats = 'Pengembalian Data pada Tanggal' + $data->created_at;


        $jaling->save();


        $history = new history_edit;
        $history->kumuh_id  = $jaling->id;
        $history->user_id   = $request->user_id;
        $history->lokasi    = $jaling->nama_lokasi;
        $history->kecamatan = $jaling->kecamatan;
        $history->kelurahan = $jaling->lokasi_keg;
        $history->luas      = $jaling->luas;
        $history->status    = $jaling->rencana;
        $history->catatan   = 'Pengembalian Data pada Tanggal '.$time.' Jam '.$time2;
        $history->stats     = 'updated';
        $history->kategori_update = $data->kategori_update;
        $history->data      = $data->data;
        $history->created_at= date('Y-m-d H:i:s', strtotime("+7 hours"));
        $history->updated_at= date('Y-m-d H:i:s', strtotime("+7 hours"));

        $history->save();


        return redirect()->route('kumuh.index')->with('success','Koordinat Telah ditambahkan.');
        // return redirect()->back()->with('success','Koordinat Telah ditambahkan.');

    }

}
