<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To set your password, complete this form: {{ URL::action('UserController@password_reset', array('token'=>$token)) }}.
		</div>
	</body>
</html>