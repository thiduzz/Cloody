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

Route::get('/', function () {
    return view('public.pages.main');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/register-foodtruck', '\App\Http\Controllers\Auth\RegisterController@showFoodtruckRegistrationForm');
Route::post('/register-foodtruck/validate', '\App\Http\Controllers\Auth\RegisterController@foodtruckAccountValidate');
Route::post('/register-foodtruck/validate-truck', '\App\Http\Controllers\Auth\RegisterController@foodtruckTruckValidate');
Route::post('/register-foodtruck', '\App\Http\Controllers\Auth\RegisterController@truck_register');


Route::get('/home', 'HomeController@index');


Route::get('/admin_oauth', ['middleware'=>'admin','uses'=>'HomeController@admin_oauth']);
Route::get('/admin_trucks', ['middleware'=>'admin','uses'=>'HomeController@admin_trucks']);
Route::get('/admin_trucks/export/{type}',['middleware'=>['admin'], 'uses' =>  'TruckController@admin_export_trucks']);

Route::get('/test',function(){

});
