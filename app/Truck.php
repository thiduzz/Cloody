<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Truck extends Model
{
    use Notifiable, Sluggable, SoftDeletes, TrackActivities;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected static $recordEvents = ['created','deleted'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'service_type', 'phone', 'identification', 'formal_name', 'status', 'logo', 'status', 'leaving_in', 'delivery_bike', 'lets_negotiate', 'delivery_motorcycle', 'enabled','slug'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function latestLocation()
    {
        return $this->hasOne('App\Location', 'id', 'latestLocation_id');
    }

    public function locations()
    {
        return $this->morphToMany('App\Location', 'localizable')->orderBy('locations.created_at','DESC');
    }

    public function service_type()
    {
        return $this->belongsTo('App\ServiceType');
    }

    public function toArray()
    {
        try{
            $array = parent::toArray();
            $array['logo_url'] = $this->getLogoUrlAttribute();
            //Carbon::setLocale('pt_BR');
            //$array['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y H:i');
            return $array;
        }catch (Exception $e)
        {
            return null;
        }
    }

    public function scopeLookFor($query, $search)
    {
        $search = str_replace('-','',str_replace('.','',$search));
        return $query
            ->orWhere('name','LIKE','%'.$search. '%')
            ->orWhere('address','LIKE','%'.$search. '%');
    }

    public function scopeDistance($query,$from_latitude,$from_longitude,$distance)
    {
        $raw = DB::raw('ROUND ( ( 6371 * acos( cos( radians('.$from_latitude.') ) * cos( radians( locations.latitude ) ) * cos( radians( locations.longitude ) - radians('.$from_longitude.') ) + sin( radians('.$from_latitude.') ) * sin( radians( locations.latitude ) ) ) ) ) AS distance,'.$from_latitude.' AS user_lat, '. $from_longitude. ' AS user_lon');
        return $query->select('*')->join('locations', 'trucks.latestLocation_id', '=', 'locations.id')->addSelect($raw)->orderBy( 'distance', 'ASC' )->having('distance', '<=', $distance);
    }


    public function scopeEnabled($query, $type = true)
    {
        return $query->where('enabled',$type);
    }

    public function getCreatedAtHumanAttribute()
    {

            if($this->avatar != '')
            {
                return "https://s3-".env('S3_REGION').".amazonaws.com/".env('S3_BUCKET').$this->logo;
            }
    }

    public function getLogoUrlAttribute()
    {
            if($this->attributes['logo'] != null)
            {
                return "https://s3-".env('S3_REGION').".amazonaws.com/".env('S3_BUCKET').$this->attributes['logo'];
            }
            return "";
    }
}
