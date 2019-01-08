<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\daerah;
use App\kategori;
use App\layer;

class layercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['daerah'] = daerah::all();
        $data['kategori'] = kategori::all();
        $data['layer'] = layer::all();

        return view('admin.layer',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/admin/layer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $layer = new layer;
        $layer->nama_layer = $request->nama_layer;
        $layer->link_layer = $request->link_layer;
        $layer->daerahs_id = $request->daerahs_id;
        $layer->kategoris_id = $request->kategoris_id;
        $layer->warna = $request->warna;
        $layer->save();

        return redirect('/admin/layer')->with('message','sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/layer');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/admin/layer');
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
        $layer = layer::find($id);
        $layer->nama_layer = $request->nama_layer;
        $layer->link_layer = $request->link_layer;
        $layer->daerahs_id = $request->daerahs_id;
        $layer->kategoris_id = $request->kategoris_id;
        $layer->warna = $request->warna;
        $layer->save();

        return redirect('/admin/layer')->with('message','sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $layer = layer::find($id);
        $layer->delete();

        return redirect('/admin/layer')->with('message','sukses');
    }
}
