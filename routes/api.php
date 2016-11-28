<?php

use App\Truck;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Antes de criar personal token rodar : php artisan passport:client --personal

Criar personal token

No postman colocar sempre no HEADER os params:
Authorization => Bearer TOKEN
Accepts => application/json

///EM PRODUCAO
php artisan passport:client --password

*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/**** TRUCKS  ****/
//get all, get queried, get by location
Route::get('/truck/{id?}', 'TruckController@index')->middleware(['auth:api']);
//update truck info
Route::put('/truck/{id}', 'TruckController@update')->middleware(['auth:api']);
//create new truck
Route::post('/truck', 'TruckController@store')->middleware(['auth:api']);
//remove truck
Route::delete('/truck', 'TruckController@destroy')->middleware(['auth:api']);


/**** LOCATIONS */
//get all, get queried
Route::get('/truck/{id}/location', 'LocationController@index_trucks')->middleware(['auth:api']);
//get all, get queried
Route::get('/user/{id}/location', 'LocationController@index_users')->middleware(['auth:api']);
//update truck position
Route::post('/truck/{id}/location', 'LocationController@store_trucks')->middleware(['auth:api']);
//get all, get queried
Route::post('/user/{id}/location', 'LocationController@store_users')->middleware(['auth:api']);

/**** USERS  ****/
//get single
Route::get('/user/{id}', 'UserController@show')->middleware(['auth:api']);
//update personal info
Route::put('/user/{id}', 'UserController@update')->middleware(['auth:api']);
//list truck members
Route::get('/truck/{id}/users', 'UserController@trucks_list')->middleware(['auth:api']);

/**** SERVICE TYPE *****/
Route::get('/service-type/{id?}', 'ServiceTypeController@index')->middleware(['auth:api']);


/** TRACKING **/
Route::get('/tracking/{type}/{id?}', 'HomeController@paginate_tracking')->middleware(['auth:api'])->middleware('admin');

/**** ADMIN  ****/
Route::get('/admin-pending-trucks', 'TruckController@admin_paginate_pending')->middleware(['auth:api'])->middleware('admin');
Route::get('/admin-current-trucks', 'TruckController@admin_paginate_current')->middleware(['auth:api'])->middleware('admin');
Route::get('/admin-trucks/export/{type}', 'TruckController@admin_export')->middleware(['auth:api'])->middleware('admin');
Route::post('/truck-approval', 'TruckController@admin_approval')->middleware(['auth:api'])->middleware('admin');
Route::post('/admin/truck/{id}', 'TruckController@admin_update')->middleware(['auth:api'])->middleware('admin');
Route::delete('/truck/{id}', 'TruckController@admin_delete')->middleware(['auth:api'])->middleware('admin');