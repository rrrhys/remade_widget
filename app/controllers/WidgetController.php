<?php

class WidgetController extends BaseController {

	public function initjs($widget_token){
		$user = User::where('widget_token','=',$widget_token)->first();
		if(!$user){
			$response = Response::make("Not authorized", 401);
			return $response;
		}
		else{
			$vars = array();
			$contents = View::make('widget/init_js')->with(array(
				'widget_token'=> $widget_token,
				'user'=>$user
				));
			$response = Response::make($contents, 200);
			$response->header('Content-Type', 'application/javascript');
			return $response;			
		}

	}
	public function test_page($widget_token){
		$user = User::where('widget_token','=',$widget_token)->first();
		if(!$user){
			$response = Response::make("Not authorized", 401);
			return $response;
		}
		else{
		return View::make('widget/test_page',array('widget_token'=>$widget_token));			
		}

	}
	public function update_stats($stat, $widget_token){
		$session_identifier = Input::get('session_identifier');
	}

}
