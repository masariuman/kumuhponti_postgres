<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\kategori;
use App\data;
use App\tampilan;
use App\daerah;
use App\jaling;


Route::get('/', 'tampilanController@front');
// Route::get('/', function(Request $req) {
// 	$kategoris = kategori::all();
// 	$datas = data::all();
// 	$daerah = daerah::all();
// 	$kecamatan = jaling::select('kecamatan')->get()->groupBy('kecamatan');

// 	// test
//     $str_data = (object) [
//                     "zoom"=> 7,
//                     "tilt"=> 0,
//                     "mapTypeId"=> "hybrid",
//                     "center"=> (object) [
//                                     "lat"=> -0.0352232,
//                                     "lng"=> 109.2613377
//                                 ],
//                     "overlays"=> []
//                 ];

// 	if (isset($req->kecamatan)) {
//             $data['jaling'] = jaling::select('data')->whereIn('kecamatan',$req->kecamatan)->whereIn('stats', ['new','updated'])->get();
//             // $data['jaling'] = jaling::where('kecamatan','like','%'.$req->kecamatan.'%')->get();
//     } else {
//     		$data['jaling'] = jaling::select('data')->whereIn('stats', ['new','updated'])->get();
//     }

	
//     $array_kecamatan = array();
//     foreach ($data['jaling'] as $key => $value) {
//         if (!empty($value->data)) {
//             $new = json_decode($value->data);
//             foreach ($new->overlays as $i => $j) {
//                 $str_data->overlays[] = $j;
//             }
//         }
//     }
//     // DD($str_data);
//     $data['str_data'] = json_encode($str_data);
//     // DD($data);
//     // return view('admin.jaling.allmap',$data);	


//     return view('front.index')->with(compact('kategoris','datas','daerah','kecamatan','array_kecamatan'))->with($data);
//     // return view('front.index',compact('kategoris','datas','daerah'));
// });


Route::get('/filter', 'tampilanController@filter');



















// Auth::routes();
// Authentication Routes...
Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

Route::get('/logout', function () {
    Auth::logout();
     return redirect('/login');
});


// Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => '',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);




// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware'=> 'auth'], function () {

	Route::resource('/data', 'dataController');
	Route::resource('/daerah', 'daerahcontroller');
	// Route::resource('/layer', 'layercontroller');
	Route::get('/layer', 'JalingController@show_all')->name('jaling.show_all');
	Route::resource('/kategori', 'kategoriController');
	// Route::resource('/jaling', 'JalingController');
	Route::resource('/kumuh', 'JalingController');
	Route::post('/jaling-import', 'JalingController@import')->name('jaling.import');
	Route::post('/jaling-export', 'JalingController@export')->name('jaling.export');
	// Route::get('/jaling-all', 'JalingController@show_all')->name('jaling.show_all');

	Route::get('/dashboard', 'tampilanController@dashboard');

	Route::get('/tampilan', 'tampilanController@index');
	// Route::get('/tampilan', function(){
	// 	$datas = tampilan::first();
	//     return view('admin.tampilan',compact('datas'));
	// });
	Route::put('/tampilan', 'tampilanController@ubahData');

	Route::get('/maps', function(){
		$kategoris = kategori::all();
		return view('admin.peta', compact('kategoris'));
	});

	Route::get('/user', 'userController@data');
	Route::post('/user', 'userController@tambahData');
	Route::put('/user', 'userController@ubahData');
	Route::delete('/user', 'userController@hapusData');


	Route::delete('/kumuh', 'JalingController@hapusData');
	Route::put('/kumuh', 'JalingController@ubahData');
	Route::patch('/kumuh', 'JalingController@hapus');

	Route::post('/kumuh/history/{id}', 'JalingController@all_history');
	Route::get('/kumuh/history/{id}', 'JalingController@all_history');
	Route::get('/kumuh/history/show/{id}', 'JalingController@all_history_show');
	Route::post('/asawawu', 'JalingController@history_restore')->name('history.restore');



	// lock Public
	// Route::get('/admin', function() {
	// 	return redirect('/login');
	// });
	// Route::get('/blitz', function() {
	// 	return view('errors.404');
	// });

});
	// Route::get('/admin', 'tampilanController@dashboard');
	// Route::get('/blitz', function() {
	// 	return view('errors.404');
	// });

Route::get('/admin', function () {
    if(!auth()->user()) {
        return 'unauthorized';
    }
});


Route::get('kondisi-bateraiku', function () {
  return view('baterai');
});