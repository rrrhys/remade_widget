<!DOCTYPE html>
<html>
<head>
	<title>{{Config::get('app.name')}} | @yield('title')</title>
	{{HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js')}}
	{{HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js')}}
	{{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css')}}

	{{HTML::style('css/main.css')}}
</head>
<body>
 @include('nav')
<div class="container">
@include('flash_messages')
@include('validation_errors')
<h3>@yield('title')</h3>
 @yield('content')
</div>
</body>
</html>
