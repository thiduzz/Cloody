<?php

namespace App\Http\Controllers;

use App\Classes\Facades\Tracking;
use App\Http\Requests\ExportResourceRequest;
use App\Http\Requests\UpdateTruckRequest;
use App\Mail\TruckAccepted;
use App\Mail\TruckDenied;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Truck;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\JsonResponse;

class TruckController extends Controller
{


    public function index(Request $request, $id = 0)
    {
        $query = $request->input('query', '');
        $limit = $request->input('limit',3);
        $page = $request->input('page',0);
        $lg = $request->input('lg',0);
        $lt = $request->input('lt',0);
        $geoforce = $request->input('geoforce',0);
        if(!is_numeric($id) || $id <= 0)
        {
            if(($lg == 0 && $lt == 0) && $geoforce == 0)
            {
                //all
                $trucks = Truck::with('service_type','latestLocation')->enabled()->lookFor($query)->skip($page*$limit)->take($limit)->get();
                return $trucks;
            }else{
                //all geolocated
                if($geoforce == 1)
                {
                    $geo = geolocate();
                    $lt = $geo['lt'];
                    $lg = $geo['lg'];
                }else if($lg == 0){
                    $geo = geolocate();
                    $lg = $geo['lg'];
                }else if($lt == 0)
                {
                    $geo = geolocate();
                    $lt = $geo['lt'];
                }
                //Casa: -25.411495, -49.259855
                $trucks = Truck::with('service_type','latestLocation')->enabled()->distance($lt,$lg, 5)->lookFor($query)->skip($page*$limit)->take($limit)->get();
                return $trucks;

            }
        }else{
            //single
            $trucks = Truck::with('service_type','latestLocation')->enabled()->where('id',$id)->first();
            return $trucks;
        }
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }


    /*****************ADMIN ***********************************/

    public function admin_delete(Request $request, $id = 0)
    {
        $truck = Truck::findOrFail($id);
        if($truck)
        {
            $truck->delete();
            return new JsonResponse(['success'=>true,'message'=> 'Truck was successfully deleted!'],200);
        }
        return new JsonResponse(['success'=>false,'message'=> 'Truck was not found!'],404);
    }

    public function admin_update(UpdateTruckRequest $request, $id)
    {
        $truck = Truck::find($id);
        if($truck)
        {
            /**
            'foodtruck_service_type_id'=>'required|exists:trucks,id',
            'foodtruck_status' => 'required|in:available,unavailable,transit,denied',
            'foodtruck_name'=>'required|min:2|max:255',
            'foodtruck_phone' => 'required',
            'foodtruck_address' => 'required|max:255',
            'foodtruck_service_type' => 'required|max:100',
            'foodtruck_identification' => 'required|min:18',
            'foodtruck_formal_name' => 'required|max:100',
            'foodtruck_lets_negotiate' => 'required',
            'foodtruck_delivery_bike' => 'required',
            'foodtruck_delivery_motorcycle' => 'required',
             */
            $data = $request->all();
            if($request->hasFile('foodtruck_new_logo')){
                $path = $request->file('foodtruck_new_logo')->store(
                    '/avatars/'.Auth::user()->id, 's3'
                );
                Storage::disk('s3')->setVisibility($path, 'public');
                $truck->logo = "/".$path;
            }else if($data['foodtruck_logo'] == "" && $data['foodtruck_logo_url'] == ""){
                $truck->logo = "";
            }
            $truck->service_type_id = $data['foodtruck_service_type_id'];
            $truck->status = $data['foodtruck_status'];
            $truck->name = $data['foodtruck_name'];
            $truck->phone = $data['foodtruck_phone'];
            $truck->address = $data['foodtruck_address'];
            $truck->identification = $data['foodtruck_identification'];
            $truck->formal_name = $data['foodtruck_formal_name'];
            $truck->lets_negotiate = intval($data['foodtruck_lets_negotiate']);
            $truck->delivery_bike = intval($data['foodtruck_delivery_bike']);
            $truck->delivery_motorcycle = intval($data['foodtruck_delivery_motorcycle']);
            $truck->save();

            return new JsonResponse(['success'=>true,'message'=> 'Truck was successfully updated!'],200);
        }
        return new JsonResponse(['success'=>false,'message'=> 'Truck was not found!'],404);
    }

    public function admin_approval(Request $request)
    {
        $type =  $request->get('type');
        $id =  $request->get('truck_id');
        $truck = Truck::with('users')->find($id);
        if($truck)
        {
            if($type == 'deny')
            {
                $truck->status = 'denied';
                $truck->save();
                Tracking::registerTrack($truck, 'denied');
                $message =  $request->get('message','Unfortunately, your foodtruck application did not fill the required parameters, please contact us in case of doubt!');

                if(env('APP_ENV') == 'local')
                {
                    Mail::to('thiago.mello@vizad.com.br')->send(new TruckDenied($truck, $message));
                }else{
                    Mail::to($truck->users[0]->email)->send(new TruckDenied($truck, $message));
                }
                return new JsonResponse(['success'=>true,'message'=> $truck->name .' was denied!'],200);
            }else if($type == 'approve'){
                $truck->enabled = 1;
                $truck->save();
                Tracking::registerTrack($truck, 'approved');
                if(env('APP_ENV') == 'local')
                {
                    Mail::to('thiago.mello@vizad.com.br')->send(new TruckAccepted($truck));
                }else{
                    Mail::to($truck->users[0]->email)->send(new TruckAccepted($truck));
                }
                return new JsonResponse(['success'=>true,'message'=> $truck->name .' was accepted!'],200);
            }
        }
        return new JsonResponse(['success'=>false,'message'=> 'Truck was not found!'],404);
    }

    public function admin_export_trucks(ExportResourceRequest $request, $type)
    {
        try{

                $ext = $request->get('extension');
                $start = Carbon::parse($request->get('start'))->startOfDay();
                $end = Carbon::parse($request->get('end'))->endOfDay();
                $trucks = Truck::with('service_type','users')->where('created_at','>=',$start->toDateTimeString())->where('created_at','<=',$end->toDateTimeString())->get();

                switch($ext)
                {
                    case 'xls':
                        Excel::create(trans('messages.report_list_trucks', ['start'=>$start->toDateString(), 'end'=>$end->toDateString()]), function($excel) use($start, $end,$trucks) {
                            // Set the title
                            $excel->setTitle(trans('messages.report_list_trucks', ['start'=>$start->toDateString(), 'end'=>$end->toDateString()]));
                            $excel->setCreator('Thiago Mello')
                                ->setCompany('Agência Vizad');

                            $excel->sheet("List", function($sheet) use($trucks){
                                $sheet->setOrientation('landscape');
                                $sheet->fromArray($trucks);
                            });
                        })->export('xls');
                        break;
                    case 'csv':
                        Excel::create(trans('messages.report_list_trucks', ['start'=>$start->toDateString(), 'end'=>$end->toDateString()]), function($excel) use($start, $end,$trucks) {
                            // Set the title
                            $excel->setTitle(trans('messages.report_list_trucks', ['start'=>$start->toDateString(), 'end'=>$end->toDateString()]));
                            $excel->setCreator('Thiago Mello')
                                ->setCompany('Agência Vizad');

                            $excel->sheet("List", function($sheet) use($trucks){
                                $sheet->setOrientation('landscape');
                                $sheet->fromArray($trucks);
                            });

                        })->export('csv');
                        break;
                    case 'xml':
                        $content = view('files.appointment.xml', compact('appointments'));
                        return response($content->render(), 200)->header('Content-Type', 'text/xml');
                        break;
                }

        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function admin_paginate_current(Request $request) {
        $query = $request->get('query');
        $limit = intval($request->get('limit'));
        $page = intval($request->get('page'));
        $orderby = $request->get('orderBy');
        $byColumn = intval($request->get('byColumn'));
        //$db = DB::table('trucks')->where('enabled', false)->where('status','!=','denied');
        $db = Truck::with('users','service_type')->where('enabled', true);
        $count = $db->count();
        $totalPages = ($limit > 0 ? ceil($count/$limit) : 0);
        $data =   $db;
        $filtered = false;
        if($byColumn == 1){
            $arr = $this->filterByColumn($data, $query);
            $data = $arr['data'];
            $filtered = $arr['filtered'];
        }else{
            $arr = $this->filter($data, $query, DB::getSchemaBuilder()->getColumnListing('trucks'));
            $data = $arr['data'];
            $filtered = $arr['filtered'];
        }
        if($filtered){
            //recount
            $count = $db->count();
        }
        //$data->offset($limit * ($page - 1))->limit($limit);
        $data->skip($limit * ($page - 1))->take($limit);
        if (isset($orderby) && $orderby)
        {
            //$direction = intval($request->get('ascending'))==1?"ASC":"DESC";
            //$data->orderBy($orderby,$direction);
            if(intval($request->get('ascending'))==1)
            {
                $data->orderBy($orderby);
            }else{
                $data->orderBy($orderby,'desc');
            }
        }
        $results = $data->get();
        return ['data'=>$results,
            'count'=>$count,
            'page'=>$page,
            'totalPages'=>$totalPages];
    }

    public function admin_paginate_pending(Request $request) {
        $query = $request->get('query');
        $limit = intval($request->get('limit'));
        $page = intval($request->get('page'));
        $orderby = $request->get('orderBy');
        $byColumn = intval($request->get('byColumn'));
        //$db = DB::table('trucks')->where('enabled', false)->where('status','!=','denied');
        $db = Truck::with('users','service_type')->where('enabled', false)->where('status','!=','denied');
        $count = $db->count();
        $totalPages = ($limit > 0 ? ceil($count/$limit) : 0);
        $data =   $db;
        $filtered = false;
        if($byColumn == 1){
            $arr = $this->filterByColumn($data, $query);
            $data = $arr['data'];
            $filtered = $arr['filtered'];
        }else{
            $arr = $this->filter($data, $query, DB::getSchemaBuilder()->getColumnListing('trucks'));
            $data = $arr['data'];
            $filtered = $arr['filtered'];
        }
        if($filtered){
            //recount
            $count = $db->count();
        }
        //$data->offset($limit * ($page - 1))->limit($limit);
        $data->skip($limit * ($page - 1))->take($limit);
        if (isset($orderby) && $orderby)
        {
            //$direction = intval($request->get('ascending'))==1?"ASC":"DESC";
            //$data->orderBy($orderby,$direction);
            if(intval($request->get('ascending'))==1)
            {
                $data->orderBy($orderby);
            }else{
                $data->orderBy($orderby,'desc');
            }
        }
        $results = $data->get();
        return ['data'=>$results,
            'count'=>$count,
            'page'=>$page,
            'totalPages'=>$totalPages];
    }

    public function filterByColumn($data, $query) {
        $filtered = false;
        foreach ($query as $field=>$query):
            if (!$query) continue;
            if (is_string($query)) {
                $data->where($field,'LIKE',"%{$query}%");
                $filtered = true;
            } else {
                $start = Carbon::createFromFormat('Y-m-d',$query['start'])->startOfDay();
                $end = Carbon::createFromFormat('Y-m-d',$query['end'])->endOfDay();
                $data->whereBetween($field,[$start, $end]);
                $filtered = true;
            }
        endforeach;
        return array('data'=>$data,'filtered'=>$filtered);
    }

    public function filter($data, $query, $fields) {
        $filtered = false;
        if($query != '')
        {
            foreach ($fields as $index=>$field):
                $method = $index?"orWhere":"where";
                $data->{$method}($field,'LIKE',"%{$query}%");
                $filtered = true;
            endforeach;
        }
        return array('data'=>$data,'filtered'=>$filtered);
    }
}
