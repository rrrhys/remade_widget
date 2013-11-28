@extends('layout')

@section('title')
Create account
@stop
@section('content')
{{Form::open(array('action'=>array('UserController@store'),'class'=>'create_user'))}}
{{Form::label('email')}} {{Form::text('email')}}<br>
{{Form::label('password')}} {{Form::password('password')}}<br>
{{Form::label('password_confirmation')}} {{Form::password('password_confirmation')}}<br>
{{Form::submit('Register',array('class'=>'btn btn-primary'))}}
{{Form::close()}}
@stop
