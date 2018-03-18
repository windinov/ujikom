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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/tampilan', function () {
    return view('tampilanuser.master');
});

Auth::routes();

Route::get('/frontend', 'FrontendController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', function(){
	return view('welcome');
});
Route::get('data','HomeController@search');
// Route::group(['middleware'=>['auth', 'role:karyawan']], function() {
// 	Route::resource('konsumen','KonsumenController');
// 	Route::resource('mobil','MobilController');
// 	Route::resource('supir','SupirController');
// 	Route::resource('sewa','sewaController');

// });


// Route::group(['middleware'=>['auth', 'role:admin']], function() {
// 	Route::resource('konsumen','KonsumenController');
// 	Route::resource('mobil','MobilController');
// 	Route::resource('supir','SupirController');
// 	Route::resource('sewa','sewaController');
// 	Route::resource('admin/user','userController');

// });
Route::group(['middleware'=>['role:admin|member']], function() {
	Route::resource('konsumen','KonsumenController');
	Route::resource('mobil','MobilController');
	Route::resource('supir','SupirController');
	Route::resource('sewa','sewaController');
	Route::resource('kembali','kembaliController');

});

Route::group(['middleware'=>['role:admin']], function() {
	Route::resource('user','userController');
});



