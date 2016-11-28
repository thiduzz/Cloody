<?php

namespace App\Http\Controllers;

use App\ServiceType;
use Illuminate\Http\Request;

use App\Http\Requests;

class ServiceTypeController extends Controller
{
    public function index(Request $request, $id = 0)
    {
        $query = $request->input('query', '');
        $limit = $request->input('limit',0);
        $page = $request->input('page',0);
        if(!is_numeric($id) || $id <= 0)
        {
            if($limit == 0)
            {
                $services = ServiceType::lookFor($query)->get();
            }else {
                $services = ServiceType::lookFor($query)->skip($page * $limit)->take($limit)->get();
            }
            return $services;
        }else{
            //single
            $service = ServiceType::where('id',$id)->first();
            return $service;
        }
    }
}
