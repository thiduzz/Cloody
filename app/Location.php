<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    protected $fillable = [
        'latitude', 'longitude'
    ];

    public function trucks()
    {
        return $this->morphedByMany('App\Truck', 'localizable');
    }

    public function users()
    {
        return $this->morphedByMany('App\User', 'localizable');
    }
}
