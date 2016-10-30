<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{

	protected $fillable = ['subject_id', 'subject_type','name','user_id','description'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function subject()
	{
		return $this->morphTo()->withTrashed();
	}

	public function toArray()
	{
		try{
			$array = parent::toArray();
			$array['track_translated'] = $this->getTranslatedAttribute();
			//Carbon::setLocale('pt_BR');
			//$array['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y H:i');
			return $array;
		}catch (Exception $e)
		{
			return null;
		}
	}

	protected function getTranslatedAttribute()
	{
		$trans_temp = json_decode($this->description);
		return trans('messages.'.$trans_temp->trans_item,(array) $trans_temp->param);
	}

}
