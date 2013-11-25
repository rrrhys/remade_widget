<?php

class SessionController extends BaseController {
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$email = Input::get('email');

		$password = Input::get('password');
		if(Auth::attempt(array(
			'email'=>$email, 
			'password'=>$password))){
			return Redirect::to('/')->with('success','Login successful!');
		}else{
			return Redirect::to('/')->with('error','Login failed.');
		}

	}

	
	public function destroy(){
		Auth::logout();
		return Redirect::to('/')->with('success','You have been logged out.');
	}

}