<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jaling;
use App\daerah;
use Excel;
use App\User;

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
            $data['datas'] = jaling::where('kecamatan','like','%'.$req->kecamatan.'%')->get();
        } else {
            $data['datas'] = jaling::all();
        }
        $data['user'] = User::all();
        $data['daerah'] = daerah::all();
        $data['kecamatan'] = jaling::select('kecamatan')->get()->groupBy('kecamatan');
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
        $data->save();


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
        $data['data'] = jaling::find($id);
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
        if ( $request->hasfile('data') ) {
            $data = Excel::load($request->data)->get();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $arr[] = [
                                'nama_lokasi'=>$value->lokasi,
                                'lokasi_keg'=>$value->kelurahan,
                                'kecamatan'=>$value->kecamatan,
                                'rencana'=>$value->status,
                                'created_at' => date('Y-m-d H:i:s', strtotime("+7 hours")),
                                'updated_at' => date('Y-m-d H:i:s', strtotime("+7 hours"))
                                // 'wilayah_id'=>$request->wilayah_id
                            ];
                }
                jaling::insert($arr);
                return redirect()->back();
            }
        }
    }

    public function show_all(Request $req)
    {
        $str_data = (object) [
                        "zoom"=> 7,
                        "tilt"=> 0,
                        "mapTypeId"=> "hybrid",
                        "center"=> (object) [
                                        "lat"=> -0.0352232,
                                        "lng"=> 109.2613377
                                    ],
                        "overlays"=> []
                    ];

        if (isset($req->kecamatan)) {
            $data['jaling'] = jaling::select('data')->where('kecamatan','like','%'.$req->kecamatan.'%')->get();
            // $data['jaling'] = jaling::where('kecamatan','like','%'.$req->kecamatan.'%')->get();
        }
        else {
            // $data['jaling'] = jaling::all()->where('kecamatan','like','%'.'PONTIANAK TIMUR'.'%')->select('data')->get();
            $data['jaling'] = jaling::select('data')->get();
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




        if (isset($req->kecamatan)) {
            $data['datas'] = jaling::where('kecamatan','like','%'.$req->kecamatan.'%')->get();
        } else {
            $data['datas'] = jaling::all();
        }
        $data['user'] = User::all();
        $data['daerah'] = daerah::all();
        $data['kecamatan'] = jaling::select('kecamatan')->get()->groupBy('kecamatan');



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
            
        try {
            $user->save();
            session(['message' => 'sukses']);
            return redirect()->action('JalingController@index');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect()->action('JalingController@index');
        }
    }

}
