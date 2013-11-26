<?php

class Role extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function User(){
		return $this->hasOne('user');
	}
}
