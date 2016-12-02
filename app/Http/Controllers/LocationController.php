<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewLocationRequest;
use App\Location;
use App\Truck;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class LocationController extends Controller
{
    public function admin_index_trucks(Request $request, $id)
    {
        $limit = $request->input('limit', 5);
        $page = $request->input('page',0);
        $start = Carbon::parse($request->get('start'))->startOfDay();
        $end = Carbon::parse($request->get('end'))->endOfDay();
        if(is_numeric($id) && $id > 0)
        {
            $trucks = Truck::with(['locations'=>function($q) use($id,$start,$end){
                $q->wherePivot('localizable_type','=','App\Truck');
                $q->wherePivot('localizable_id','=', $id);
                $q->wherePivot('created_at', '>=', $start);
                $q->wherePivot('created_at', '<', $end);
                $q->orderBy('created_at');
            }])->where('id',$id)->first();
            if($trucks)
            {
                $locations = $trucks->locations()->skip($page*$limit)->take($limit)->get();
                return ['truck'=>$trucks, 'locations'=>$locations];
            }
            return new JsonResponse([
                "status" => 404,
                "userMessage" => "The requested resource was not found",
                "errorCode" => "5001"],404);
        }
        return new JsonResponse([
            "status" => 422,
            "userMessage" => "An invalid argument was passed to the API. Make sure the ID is a numeric.",
            "errorCode" => "5001"],422);
    }

    public function index_trucks(Request $request, $id)
    {
        $limit = $request->input('limit', 5);
        $page = $request->input('page',0);
        if(is_numeric($id) && $id > 0)
        {
                $trucks = Truck::with('service_type','latestLocation')->enabled()->where('id',$id)->first();
                if($trucks)
                {
                    $locations = $trucks->locations()->skip($page*$limit)->take($limit)->get();
                    return ['truck'=>$trucks, 'locations'=>$locations];
                }
                return new JsonResponse([
                    "status" => 404,
                    "userMessage" => "The requested resource was not found",
                    "errorCode" => "5001"],404);
        }
        return new JsonResponse([
            "status" => 422,
            "userMessage" => "An invalid argument was passed to the API. Make sure the ID is a numeric.",
            "errorCode" => "5001"],422);
    }

    public function index_users(Request $request, $id)
    {
        $limit = $request->input('limit', 5);
        $page = $request->input('page',0);
        if(is_numeric($id) && $id > 0)
        {
            $user = User::find($id);
            if($user)
            {
                $locations = Location::with(array('users' => function($q) use($id)
                {
                    $q->wherePivot('localizable_type','App\User');
                    $q->wherePivot('localizable_id', $id);
                    $q->orderBy('created_at');
                }))->skip($page*$limit)->take($limit)->get();
                return ['user'=>$user, 'locations'=>$locations];
            }
            return new JsonResponse([
                "status" => 404,
                "userMessage" => "The requested resource was not found",
                "errorCode" => "5001"],404);
        }
        return new JsonResponse([
            "status" => 422,
            "userMessage" => "An invalid argument was passed to the API. Make sure the ID is a numeric.",
            "errorCode" => "5001"],422);
    }

    public function store_trucks(NewLocationRequest $request, $id)
    {
        if(is_numeric($id) && $id > 0) {
            $truck = Truck::with('locations','latestLocation')->where('id',$id)->first();
            if($truck)
            {
                if(Auth::user()->isTruckMember($id))
                {
                    $location = Location::create(['latitude' => $request->input('latitude', 0), 'longitude' => $request->input('longitude', 0), 'created_at' => Carbon::now()->toDateTimeString()]);
                    $truck->locations()->save($location);
                    if ($truck->latestlocation_id == null || ($truck->latestlocation != null ? Carbon::now() >= $truck->latestlocation->created_at : false)) {
                        $truck->latestlocation_id = $location->id;
                        $truck->save();
                    }
                    return new JsonResponse([
                        "status" => 200,
                        "userMessage" => "Location successfully inserted",
                        "errorCode" => "5001"],404);
                }
                return new JsonResponse([
                    "status" => 403,
                    "userMessage" => "Forbidden, you don't have  this permission!",
                    "errorCode" => "5001"],403);
            }
            return new JsonResponse([
                "status" => 404,
                "userMessage" => "The requested resource was not found",
                "errorCode" => "5001"],404);
        }
        return new JsonResponse([
            "status" => 422,
            "userMessage" => "An invalid argument was passed to the API. Make sure the ID is a numeric.",
            "errorCode" => "5001"],422);
    }

    public function store_users(NewLocationRequest $request, $id)
    {
        if(is_numeric($id) && $id > 0) {
            $user = User::with('locations')->where('id',$id)->first();
            if($user)
            {
                $location = Location::create(['latitude' => $request->input('latitude', 0), 'longitude' => $request->input('longitude', 0), 'created_at' => Carbon::now()->toDateTimeString()]);
                $user->locations()->save($location);
            }
            return new JsonResponse([
                "status" => 404,
                "userMessage" => "The requested resource was not found",
                "errorCode" => "5001"],404);
        }
        return new JsonResponse([
            "status" => 422,
            "userMessage" => "An invalid argument was passed to the API. Make sure the ID is a numeric.",
            "errorCode" => "5001"],422);
    }
}
