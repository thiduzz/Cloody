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
			$array['translated'] = $this->getTranslatedAttribute();
			$array['icon_code'] = $this->getIconCode();
			$array['icon_color'] = $this->getIconColor();
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
		if($this->description != '')
		{
			$trans_temp = json_decode($this->description);
			return trans('messages.'.$trans_temp->trans_item,(array) $trans_temp->param);
		}
		return null;
	}

	private function getIconColor()
	{

		switch($this->name)
		{
			case 'created_truck':
			case 'created_user':
				return '#48b0f7';
				break;
			case 'deleted_truck':
				return '#f55753';
				break;
			case 'approved':
				return '#10cfbd';
				break;
			case 'denied':
				return '#f55753';
				break;

		}
		return null;
	}

	private function getIconCode()
	{
		switch($this->name)
		{
			case 'created_truck':
			case 'created_user':
				return 'fa-star-o';
				break;
			case 'deleted_truck':
				return 'fa-trash-o';
				break;
			case 'approved':
				return 'fa-thumbs-o-up';
				break;
			case 'denied':
				return 'fa-ban';
				break;

		}
		return null;
	}

}
