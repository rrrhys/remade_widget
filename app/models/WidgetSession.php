<?php

class WidgetSession extends Eloquent {
	protected $guarded = array();
	protected $table = 'widget_session';

	public static $rules = array();

	public function widget(){
		return $this->belongsTo("widget");
	}
}
