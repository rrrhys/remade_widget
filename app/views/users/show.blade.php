@extends('layout')

@section('title')
{{$user->email}}
	@unless($user->parent_id == 0)
		<small>Sub-account of {{$user->parent->email}}</small>
	@endunless
@stop
@section('content')

<pre>{{URL::action('WidgetController@initjs',array($widget_token))}}</pre>
<small>{{link_to_action('WidgetController@test_page','Visit test page',array($widget_token))}}</small>

@if($user->parent_id == 0)
<h4>Sub Accounts</h4>
<table class="table table-striped table-bordered">
	<tr>
		<th>Email Address</th>
		<th>Activated</th>
		<th>Actions</th>
	</tr>
@foreach($user->children as $child)
<td>{{$child->email}}</td>
<td>{{$child->password == '' ? 'No' : 'Yes'}}</td>
<td>
	@if(!$child->password)
	{{link_to_action('UserController@send_child_password_reset', 'Resend Activation Email',array('id'=>$child->id))}}
	@endif
</td>
<tr>
</tr>
@endforeach
<tr><td colspan='3'>
	{{Form::open(array('action'=>array('UserController@store')))}}
{{Form::label('email','New user')}} {{Form::text('email')}} 
{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
{{Form::close()}}
</td></tr>
</table>
@endif
@stop
