<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = kategori::all();
        return view('admin.kategori.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategori = new kategori;
        $kategori->nama = $request->nama;
        if ($request->icon!=null) {
            $kategori->icon = $request->icon;
        } else {$kategori->icon= '/marker/default.png';}
        if ($request->icon_ex!=null) {
            $kategori->icon_ex = $request->icon_ex;
        } else {$kategori->icon_ex= '/marker/default_ex.png';}
         try {
            $kategori->save();
            session(['message' => 'sukses']);
            return redirect('/admin/kategori');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect('/admin/kategori');
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
        return redirect('/admin/kategori');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = kategori::find($id);
        return view('admin.kategori.edit',compact('datas'));
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
        $kategori = kategori::find($id);
        $kategori->nama = $request->nama;
        if ($request->icon!=null) {
            $kategori->icon = $request->icon;
        } else {$kategori->icon= '/marker/default.png';}
        if ($request->icon_ex!=null) {
            $kategori->icon_ex = $request->icon_ex;
        } else {$kategori->icon_ex= '/marker/default_ex.png';}
         try {
            $kategori->save();
            session(['message' => 'sukses']);
            return redirect('/admin/kategori');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect('/admin/kategori');
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
        $kategori = kategori::find($id);
         try {
            $kategori->delete();
            session(['message' => 'sukses']);
            return redirect('/admin/kategori');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect('/admin/kategori');
        }
    }
}
