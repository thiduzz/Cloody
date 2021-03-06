<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Classes\Facades\Tracking;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('public.pages.main');
});

Auth::routes();
Route::get('auth/facebook', 'Auth\FacebookController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleProviderCallback');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/register-foodtruck', '\App\Http\Controllers\Auth\RegisterController@showFoodtruckRegistrationForm');
Route::post('/register-foodtruck/validate', '\App\Http\Controllers\Auth\RegisterController@foodtruckAccountValidate');
Route::post('/register-foodtruck/validate-truck', '\App\Http\Controllers\Auth\RegisterController@foodtruckTruckValidate');
Route::post('/register-foodtruck', '\App\Http\Controllers\Auth\RegisterController@truck_register');


Route::get('/home', 'HomeController@index');


Route::get('/admin_oauth', ['middleware'=>'admin','uses'=>'HomeController@admin_oauth']);
Route::get('/admin_trucks', ['middleware'=>'admin','uses'=>'HomeController@admin_trucks']);
Route::get('/admin_trucks/edit/{id}', ['middleware'=>'admin','uses'=>'HomeController@admin_trucks_edit']);
Route::get('/admin_trucks/export/{type}',['middleware'=>['admin'], 'uses' =>  'TruckController@admin_export_trucks']);

Route::get('/test',function(){
    //$truck = \App\Truck::find(1);
    //$track = Tracking::registerTrack($truck, 'approved');
    //return $track->translated;
    $user = Socialite::driver('facebook')->stateless()->user();
    var_dump($user);
});
