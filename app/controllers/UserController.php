<?php

class UserController extends BaseController {

	public function create(){
		return View::make('users/create');
	}

	public function store(){
		$enable_outside_registrations = Config::get('app.enable_outside_registrations');
		$email =Input::get('email');
		if(!$enable_outside_registrations && $email != "rrrhys@gmail.com"){
			return Redirect::to('/')->with('error','Registrations are diabled.');
		}
		$user_exists = User::where('email', '=', $email)->count() > 0;
		$user = new User;
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		Auth::loginUsingId($user->id);
		return Redirect::to("/")->with('success','Account created successfully!');
	}
}