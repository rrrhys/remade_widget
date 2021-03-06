<?php

class WidgetController extends BaseController {

	public function js($widget_token){
		$user = User::where('widget_token','=',$widget_token)->first();
		if(!$user){
			$response = Response::make("Not authorized", 401);
			return $response;
		}
		else{

			//load the session that came in with the cookie, otherwise make a new session.
			$existing_widget_session_id_from_cookie = Cookie::get('widget_session_id');

			$widget_session = $user->widget->sessions()->where('id','=',$existing_widget_session_id_from_cookie)->first();
			if(!$widget_session){
				$widget_session = new WidgetSession();
				$widget_session->token = str_random(16);
				$user->widget->sessions()->save($widget_session);
				Cookie::queue('widget_session_id', $widget_session->id, 60);
			}


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
	public function css($widget_token){
		$contents = View::make('widget/host_css');
			$response = Response::make($contents, 200);
			$response->header('Content-Type', 'text/css');
			return $response;			
	}
	public function iframe($widget_token){
		return View::make('widget/iframe_contents',array('widget_token'=>$widget_token));
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
	public function update_stats(){
		$stat = Input::get('stat');
		$widget_token = Input::get('widget_token');
		$user = User::where('widget_token','=',$widget_token)->first();
		$existing_widget_session_id_from_cookie = Cookie::get('widget_session_id');

		$widget_session = $user->widget->sessions()->where('id','=',$existing_widget_session_id_from_cookie)->first();
		$widget_session->last_loaded = date( 'Y-m-d H:i:s', time());
		$widget_session->save();
		$response = Response::make($widget_session->toJson(), 200);
			return $response;
	}

}
