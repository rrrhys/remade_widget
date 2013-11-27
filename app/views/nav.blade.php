<div class="navbar navbar-default navbar-static-top">
		<a class="navbar-brand" href="/">Widget</a>
		<ul class="nav navbar-nav">

			@if (Auth::check())
				<li class='dropdown'>
					<a class='dropdown-toggle' data-toggle='dropdown' href='#'>
						Signed in as {{Auth::user()->email}} <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							{{link_to_action('SessionController@destroy','Sign Out')}}
						</li>

					</ul>
				</li>

			@else
				<!--li>{{link_to_action('UserController@create','Sign in')}}</li-->
				<li class='dropdown'>
					<a class='signin_popup' data-toggle='dropdown'>
						Sign in
					</a>

	<div class="dropdown-menu" style='padding: 20px;'>
		{{ Form::open(array('action'=>array('SessionController@create')))}}
{{Form::label('email')}}
{{Form::text('email')}}

<br>
{{Form::label('password')}}
{{Form::password('password')}}
{{Form::submit('Click')}}
		{{Form::close()}}
	</div>

				</li>
				<li>{{link_to_action('UserController@create','Create Account')}}</li>
				<li>{{link_to_action('UserController@create','To Dos')}}</li>
			@endif
			
		</ul>
	</div>

	<script>
	$(function(){
		$(".signin_popup").on('click',function(){
			$(".signin-menu").popover();
		});
	})
	</script>
