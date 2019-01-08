<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\daerah;

class daerahcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['daerah'] = daerah::all();

        return view('admin.daerah',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/admin/daerah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $daerah = new daerah;
        $daerah->nama_daerah = $request->nama_daerah;
        $daerah->x = $request->x;
        $daerah->y = $request->y;
        $daerah->save();

        return redirect('/admin/daerah')->with('message','sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/daerah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/admin/daerah');
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
        $daerah = daerah::find($id);
        $daerah->nama_daerah = $request->nama_daerah;
        $daerah->x = $request->x;
        $daerah->y = $request->y;
        $daerah->save();

        return redirect('/admin/daerah')->with('message','sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daerah = daerah::find($id);
        $daerah->delete();

        return redirect('/admin/daerah')->with('message','sukses');
    }

    public function caridaerah($id)
    {
        $daerah = daerah::find($id);
        return $daerah;
    }
}
