<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'truck_id', 'radius', 'notification_text','image','valid_until'
    ];
}
