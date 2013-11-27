@extends('layout')

@section('title')
Set a new password
@stop
@section('content')
{{Form::open(array('action'=>array('UserController@save_new_password')))}}
{{Form::hidden('token', $token)}}
{{Form::label('password')}} {{Form::password('password')}}<br>
{{Form::label('password_confirmation')}} {{Form::password('password_confirmation')}}<br>
{{Form::submit('Save password',array('class'=>'btn btn-primary'))}}
{{Form::close()}}
@stop