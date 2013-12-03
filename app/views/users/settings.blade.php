@extends('layout')

@section('title')
{{$user->email}} - settings
@stop
@section('content')

<pre>{{URL::action('WidgetController@js',array($user->widget_token))}}</pre>


<h4>Settings</h4>
{{Form::model($user->settings,array('action'=>array('UserController@storeSettings')))}}
{{Form::label('base_url')}} {{Form::text('base_url')}}
{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
{{Form::close()}}

@stop