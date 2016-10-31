<?php namespace App\Classes;

use App\Track;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tracking {
    public function registerTrack($model, $type)
    {
        return Track::create([
            'subject_id'=> $model->id,
            'subject_type'=> get_class($model),
            'name'=> $type,
            'user_id'=> (Auth::check() ? Auth::user()->id : 0),
            'description'=> $this->generate_description($model,$type)
        ]);
    }

    protected function generate_description($model, $type)
    {
        switch(get_class($model)){
            case 'App\Truck':
                switch($type)
                {
                    case 'updated':
                        return json_encode(['trans_item'=>'track_updated_truck','param'=>['name'=>$model->name]]);
                        break;
                    case 'approved':
                        return json_encode(['trans_item'=>'track_approved_truck','param'=>['name'=>$model->name]]);
                        break;
                    case 'denied':
                        return json_encode(['trans_item'=>'track_denied_truck','param'=>['name'=>$model->name]]);
                        break;
                }
                break;
            case 'App\User':
                break;
        }
    }
}