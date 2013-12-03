<?php

class TestController extends BaseController {

	public function teardown(){
		$user = User::where('email','=','rrrhys+tester@gmail.com');
		$user->delete();
		return 'Teardown complete';
	}
	public function prepare(){
		return 'Preparation complete';
	}
}
