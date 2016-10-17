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

/**** USERS  ****/
//get single
Route::get('/user/{id}', 'UserController@show')->middleware(['auth:api']);
//create new user
Route::post('/user', 'UserController@store')->middleware(['auth:api']);
//update personal info
Route::put('/user/{id}', 'UserController@update')->middleware(['auth:api']);

/**** ADMIN  ****/
Route::get('/admin-pending-trucks', 'TruckController@admin_paginate_pending')->middleware(['auth:api'])->middleware('admin');
Route::get('/admin-current-trucks', 'TruckController@admin_paginate_current')->middleware(['auth:api'])->middleware('admin');
Route::get('/admin-trucks/export/{type}', 'TruckController@admin_export')->middleware(['auth:api'])->middleware('admin');
Route::post('/truck-approval', 'TruckController@admin_approval')->middleware(['auth:api'])->middleware('admin');