<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionTicket extends Model
{
    protected $fillable = [
        'user_id', 'promotion_id','qr_code','nfc_code','hash_code'
    ];
}
