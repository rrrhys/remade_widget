<?php

class UserController extends BaseController {
	private function get_password_reset_token(){
		return str_random(40);
	}
	public function create(){
		return View::make('users/create');
	}
	public function show(){
		$user = Auth::user();
		if(!$user){
			return Redirect::to('/')->with('error','You need to be signed in to go to the dashboard.');
		}
		$widget_token = $user->widget_token;
		if(!$widget_token){
			$widget_token = $user->parent->widget_token;
		}
		return View::make('users/show',array('user'=>$user,'widget_token'=>$widget_token));
	}
	public function password_reset($token){
		return View::make('users/password_reset',array('token'=> $token));
	}
	public function save_new_password(){
		$user = User::where('password_reset_token','=',Input::get('token'))->first();
		if(!$user){
			return Redirect::to('/')->with('error','Invalid token.');
		}
		    $rules = array(
		    	'password'=>'required|min:8|confirmed'
		    	);
		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()){
			return Redirect::action('UserController@password_reset',array('token'=>Input::get('token')))->withErrors($validator);
		}
		else{
			$user->password = Hash::make(Input::get('password'));
			$user->password_reset_token = null;
			$user->save();
			Auth::loginUsingId($user->id);
			return Redirect::to("/dashboard")->with('success','Password set successfully!');		
		}
		echo $user->id;
	}
	public function send_child_password_reset($id){
		$user = Auth::user();
		$child_user = $user->children()->where('id','=',$id)->first();

		if($child_user){
			$child_user->password_reset_token = $this->get_password_reset_token();
			$child_user->save();
			Mail::send('emails.auth.reminder', array('token'=>$child_user->password_reset_token), function($message) Use ($child_user)
		        {
		            $message->to($child_user->email, $child_user->email)->from('rrrhys@gmail.com')->subject('Activate your account!');
		        });
			return Redirect::to("/dashboard")->with('success','The account activation email was resent to  '.$child_user->email.'.');	

		}else{
			return Redirect::to("/")->with('error','Unauthorised.');	

		}
	}
	public function store(){

		$logged_in_user = Auth::user();
		$email =Input::get('email');
		$user_exists = User::where('email', '=', $email)->count() > 0;

		if($logged_in_user){
			//secondary user to this account.
			$parent_user = Auth::user();
			$user = new User;
			$user->email = Input::get('email');

			$user->parent_id = $parent_user->id;
			$user->save();
			$role = new Role;
			$role->root = false;
			$role->admin = false;
			$user->role()->save($role);

			$settings = new Settings;
			$user->settings()->save($settings);

			$widget_properties = new Widget_Properties;
			$user->widget_properties()->save($widget_properties);

			$user->password_reset_token = $this->get_password_reset_token();
			$user->save();
			Mail::send('emails.auth.login_to_set_password', array('token'=>$user->password_reset_token), function($message) Use ($user)
		        {
		            $message->to($user->email, $user->email)->from('rrrhys@gmail.com')->subject('Activate your account!');
		        });


			return Redirect::to("/dashboard")->with('success','Account created successfully - ask user '.$user->email.' to follow the instructions in their email.');		

		}
		else{
			//is a new user
		    $rules = array(
		    	'email'=>'required|email|unique:users',
		    	'password'=>'required|min:8|confirmed'
		    	);

		    $validator = Validator::make(Input::all(), $rules);
		    if($validator->fails()){
		    	return Redirect::action('UserController@create')->withErrors($validator);
		    }else{
				$enable_outside_registrations = Config::get('app.enable_outside_registrations');
				
				if(!$enable_outside_registrations && $email != "rrrhys@gmail.com"){
					return Redirect::to('/')->with('error','Registrations are diabled.');
				}
				
				$user = new User;
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));
				$user->widget_token = str_random(16);

				$user->save();
				$role = new Role;
				$role->root = true;
				$role->admin = false;
				$user->role()->save($role);

				$widget = new Widget();
				$widget->start_open = false;
				$user->widget()->save($widget);
				

				Auth::loginUsingId($user->id);
				return Redirect::to("/dashboard")->with('success','Account created successfully!');		
			}	
		}

	}
	public function settings(){
		$user = Auth::User();
		$settings = $user->settings();

		return View::make('users/settings',array('settings'=>$settings,'user'=>$user));
	}
	public function storeSettings(){
		$user = Auth::user();
		$settings = $user->settings;
		if(!$settings){
			$settings = new Settings;
			$user->settings()->save($settings);
		}
		$settings->base_url = Input::get('base_url');
		$settings->save();
		return Redirect::action('UserController@settings')->with('success','Settings saved!');
	}
}
