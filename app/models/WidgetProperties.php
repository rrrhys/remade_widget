<?php

class WidgetProperties extends Eloquent {
	protected $guarded = array();
	protected $table = 'widget_properties';
	public static $rules = array();
	public function owner(){
		return $this->belongsTo('User');
	}
}
