<?php

namespace App\Http\Controllers;

use App\Track;
use App\Truck;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JavaScript;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'paginate_tracking']);
    }

    public function index()
    {
        return view('home.pages.dashboard');
    }

    public function admin_oauth()
    {
        return view('home.pages.admin.oauth');
    }

    public function admin_trucks()
    {
        return view('home.pages.admin.trucks');
    }

    public function admin_trucks_edit($id)
    {
        $truck = Truck::with('users','service_type')->find($id);
        if($truck){
            JavaScript::put([
                'truck' => $truck
            ]);
            return view('home.pages.admin.edit_trucks',compact('id'));

        }
        abort(404);
    }

    public function paginate_tracking($type, $id = 0)
    {
        if($type)
        {
            switch($type)
            {
                case 'trucks':
                    $tracks = Track::with('user','subject')->whereIn('subject_type', ['App\Truck'])->latest()->simplePaginate(12);
                    return new JsonResponse(['success'=>true,'tracks'=> $tracks],200);
                    break;
                case 'truck':
                    if(is_numeric($id) && $id > 0)
                    {
                        $tracks = Track::with('user','subject')->where('subject_id', $id)->whereIn('subject_type', ['App\Truck'])->latest()->simplePaginate(8);
                        return new JsonResponse(['success'=>true,'tracks'=> $tracks],200);
                    }
                    return new JsonResponse(['success'=>false,'message'=> 'Invalid subject ID'],422);
                    break;
            }
        }
        return new JsonResponse(['success'=>false,'message'=> 'Invalid tracking type'],422);
    }

}
