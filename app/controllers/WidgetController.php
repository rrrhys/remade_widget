<?php

class WidgetController extends BaseController {

	public function js($widget_token){
		$user = User::where('widget_token','=',$widget_token)->first();
		$widget_session = new WidgetSession();
		$widget_session->token = str_random(16);
		//echo $user->widget->id;
		//die();
		$user->widget->sessions()->save($widget_session);
		if(!$user){
			$response = Response::make("Not authorized", 401);
			return $response;
		}
		else{
			$vars = array();
			$contents = View::make('widget/init_js')->with(array(
				'widget'=>$user->widget,
				'session'=>$widget_session,
				'token'=>$user->widget_token,
				'jquery_url'=>'//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'
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
	public function update_stats($stat){
		
	}

}
