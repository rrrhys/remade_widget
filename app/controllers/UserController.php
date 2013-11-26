<?php

class UserController extends BaseController {

	public function create(){
		return View::make('users/create');
	}
	public function show(){
		$user = Auth::user();
		return View::make('users/show',array('user'=>$user));
	}
	public function child_password_reset($id){
		$user = Auth::user();
		$child_user = $user->children()->where('id','=',$id)->first();

		if($child_user){
			Mail::send('emails.auth.reminder', array('token'=>'DUMMY'), function($message) Use ($child_user)
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
			return Redirect::to("/dashboard")->with('success','Account created successfully - ask user '.$user->email.' to follow the instructions in their email.');		

		}
		else{
			//is a new user
		    $rules = array(
		    	'email'=>'required|email|unique:users',
		    	'password'=>'required|min:8'
		    	);

		    $validator = Validator::make(Input::all(), $rules);
			$enable_outside_registrations = Config::get('app.enable_outside_registrations');
			
			if(!$enable_outside_registrations && $email != "rrrhys@gmail.com"){
				return Redirect::to('/')->with('error','Registrations are diabled.');
			}
			
			$user = new User;
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));

			$user->save();
			$role = new Role;
			$role->root = true;
			$role->admin = false;
			$user->role()->save($role);


			

			Auth::loginUsingId($user->id);
			return Redirect::to("/")->with('success','Account created successfully!');			
		}

	}
}