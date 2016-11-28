<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ServiceType extends Model
{
    protected $fillable = ['name'];
    use Sluggable;
    
	public $timestamps = false;

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

    public function scopeLookFor($query, $search)
    {
        if($search != '')
        {
            $search = str_replace('-','',str_replace('.','',$search));
            return $query
                ->orWhere('name','LIKE','%'.$search. '%');
        }
        return $query;
    }
}
