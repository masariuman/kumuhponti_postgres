<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data;
use App\kategori;
use App\daerah;
use App\jaling;

class dataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = data::all();
        return view('admin.data.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kategoris'] = kategori::all();
        $data['daerah'] = daerah::all();
        return view('admin.data.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = new data;
        $datas->kategoris_id = $request->kategoris_id;
        $datas->no_spk = $request->no_spk;
        $datas->tgl_spk = $request->tgl_spk;
        $datas->no_adendum = $request->no_adendum;
        $datas->tgl_adendum = $request->tgl_adendum;
        $datas->nama_pr = $request->nama_pr;
        $datas->alamat_pr = $request->alamat_pr;
        $datas->direktur = $request->direktur;
        $datas->judul_pekerjaan = $request->judul_pekerjaan;
        $datas->volume = $request->volume;
        $datas->lokasi = $request->lokasi;
        $datas->kab_kota = $request->kab_kota;
        $datas->pagu = $request->pagu;
        $datas->nilai = $request->nilai;
        $datas->sisa = $request->sisa;
        $datas->persen = $request->persen;
        $datas->no_pho = $request->no_pho;
        $datas->tgl_pho = $request->tgl_pho;
        $datas->ket_pho = $request->ket_pho;
        $datas->no_bast = $request->no_bast;
        $datas->tgl_bast = $request->tgl_bast;
        $datas->ket_bast = $request->ket_bast;
        $datas->x = $request->x;
        $datas->y = $request->y;
        $datas->daerahs_id = $request->daerahs_id;
        try {
            $datas->save();
            session(['message' => 'sukses']);
            return redirect('/admin/data');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect('/admin/data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = data::find($id);
        return view('admin.data.show',compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['kategoris'] = kategori::all();
        $data['daerah'] = daerah::all();
        $data['datas'] = data::find($id);

        return view('admin.data.edit',$data);
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
        $datas = data::find($id);
        $datas->kategoris_id = $request->kategoris_id;
        $datas->no_spk = $request->no_spk;
        $datas->tgl_spk = $request->tgl_spk;
        $datas->no_adendum = $request->no_adendum;
        $datas->tgl_adendum = $request->tgl_adendum;
        $datas->nama_pr = $request->nama_pr;
        $datas->alamat_pr = $request->alamat_pr;
        $datas->direktur = $request->direktur;
        $datas->judul_pekerjaan = $request->judul_pekerjaan;
        $datas->volume = $request->volume;
        $datas->lokasi = $request->lokasi;
        $datas->kab_kota = $request->kab_kota;
        $datas->pagu = $request->pagu;
        $datas->nilai = $request->nilai;
        $datas->sisa = $request->sisa;
        $datas->persen = $request->persen;
        $datas->no_pho = $request->no_pho;
        $datas->tgl_pho = $request->tgl_pho;
        $datas->ket_pho = $request->ket_pho;
        $datas->no_bast = $request->no_bast;
        $datas->tgl_bast = $request->tgl_bast;
        $datas->ket_bast = $request->ket_bast;
        $datas->x = $request->x;
        $datas->y = $request->y;
        $datas->daerahs_id = $request->daerahs_id;
        try {
            $datas->save();
            session(['message' => 'sukses']);
            return redirect('/admin/data');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect('/admin/data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datas = data::find($id);
        try {
            $datas->delete();
            session(['message' => 'sukses']);
            return redirect('/admin/data');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect('/admin/data');
        } 
    }

    public function CariData($id)
    {
        $data = jaling::where('id',$id)->first();
        return $data;
    }

    public function SemuaData()
    {
        $data = data::with('kategori')->get();
        return $data;
    }
}
