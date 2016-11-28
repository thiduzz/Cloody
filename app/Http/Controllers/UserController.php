<?php

namespace App\Http\Controllers;

use App\Http\Requests\TruckUsersRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function trucks_list(Request $request, $id)
    {
        if(Auth::user()->hasRole("admin") || Auth::user()->isTruckMember($id))
        {
            $query = $request->get('query');
            $limit = intval($request->get('limit'));
            $page = intval($request->get('page'));
            $orderby = $request->get('orderBy');
            $byColumn = intval($request->get('byColumn'));
            //$db = DB::table('trucks')->where('enabled', false)->where('status','!=','denied');
            $db = User::whereHas('trucks', function ($query) use($id){
                $query->where('truck_id', '=', $id);
            });
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
        return ['data'=>[],
            'count'=>0,
            'page'=>0,
            'totalPages'=>0,
            'error'=>"Not authorized"];

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
