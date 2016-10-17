<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles;
    use Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','hometown', 'type', 'age', 'avatar', 'preferences','slug'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => null
            ]
        ];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function locations()
    {
        return $this->morphToMany('App\Location', 'localizable');
    }


    public function department()
    {
        return $this->belongsToMany('App\Truck');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function toArray()
    {
        $array = parent::toArray();
        return $array;
    }


    public function getCreatedAtHumanAttribute()
    {
        Carbon::setLocale('pt_BR');
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans();
    }

    public function getAvatarLinkAttribute()
    {
        return 'https://s3-'.env('S3_REGION').'.amazonaws.com/'.env('S3_BUCKET').'/'.$this->logo;
    }

    public function setImpersonating($id)
    {
        Session::put('impersonate', $id);
    }

    public function stopImpersonating()
    {
        Session::forget('impersonate');
    }

    public function isImpersonating()
    {
        return Session::has('impersonate');
    }
}