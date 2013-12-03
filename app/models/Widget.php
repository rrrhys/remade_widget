<?php

class Widget extends Eloquent {
	protected $guarded = array();
	protected $table = 'widget';
	public static $rules = array();
	public function owner(){
		return $this->belongsTo('User');
	}
	public function sessions(){
		return $this->hasMany('WidgetSession');
	}
}
