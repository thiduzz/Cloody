<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 9/14/2015
 * Time: 6:14 AM
 */

namespace App;


use Illuminate\Support\Facades\Auth;
use ReflectionClass;
use stdClass;

trait TrackActivities {

	protected static function bootTrackActivities()
	{
		foreach(static::getModelEvents() as $event)
		{
			static::$event(function($model) use ($event) {
				$model->recordActivity($event);
			});
		}

	}

	public function recordActivity($event)
	{
		Track::create([
				'subject_id'=>$this->id,
				'subject_type'=>get_class($this),
				'name'=>$this->getActivityName($this, $event),
				'user_id'=> (Auth::check() ? Auth::user()->id : 0)
		]);
	}

	protected function getActivityName($model, $action)
	{
		$name = strtolower((new ReflectionClass($model))->getShortName());
		return "{$action}_{$name}";
	}

	protected static function getModelEvents()
	{
		if(isset(static::$recordEvents)){
			return static::$recordEvents;
		}
		return ['created','deleted','updated'];
	}

} 