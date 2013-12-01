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
			$contents = View::make('init_js')->with('widget_token', $widget_token);
			$response = Response::make($contents, 200);
			$response->header('Content-Type', 'application/javascript');
			return $response;			
		}

	}

}
