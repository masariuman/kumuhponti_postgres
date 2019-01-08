<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class userController extends Controller
{
	public function CariUser($id)
    {
    	$data = User::find($id);
    	return $data;
    }

    public function data()
    {
    	$data = User::where('active',1)->get();
    	return view('admin.user',['datas'=>$data]);
    }

    public function tambahData(Request $request)
    {
        
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->foto = $request->foto;
        try {
            $user->save();
            session(['message' => 'sukses']);
            return redirect()->action('userController@data');
        }
        catch(Exception $e){
            session(['message' => 'error','error' => $e]);
            return redirect()->action('userController@data');
        }
    }

    public function ubahData(Request $request)
    {
            $user = User::find($request->id);
            if ($request->password!=null) {
                if (Hash::check($request->old_password, $user->password))
                {
                    // The passwords match...
                    $user->password = bcrypt($request->password);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    
                    $user->foto = $request->foto;
                    try {
                        $user->save();
                        session(['message' => 'sukses']);
                        return redirect()->action('userController@data');
                    }   
                    catch(Exception $e){
                        session(['message' => 'error','error' => $e]);
                        return redirect()->action('userController@data');
                    }
                }
                else {
                    session(['message' => 'salah']);
                    return redirect()->action('userController@data');
                }                
            }

    }

    public function hapusData(Request $request)
    {
        $user = User::find($request->id);
            if ($request->password!=null) {
                if (Hash::check($request->password, $user->password))
                {
                    // The passwords match...
                    $user->active = 0;
                    try {
                        $user->save();
                        session(['message' => 'sukses']);
                        return redirect()->action('userController@data');
                    }   
                    catch(Exception $e){
                        session(['message' => 'error','error' => $e]);
                        return redirect()->action('userController@data');
                    }
                }
                else {
                    session(['message' => 'salah2']);
                    return redirect()->action('userController@data');
                }                
            } else {
                session(['message' => 'salah2']);
                return redirect()->action('userController@data');
            }
        //     $user = User::find($request->id);
        // try {
        //     $user->delete();
        //     session(['message' => 'sukses']);
        //     return redirect()->action('userController@data');
        // }
        // catch(Exception $e){
        //     session(['message' => 'error','error' => $e]);
        //     return redirect()->action('userController@data');
        // }
    }
}
