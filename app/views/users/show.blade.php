@extends('layout')

@section('title')
{{$user->email}}
@stop
@section('content')

<pre>{{URL::action('WidgetController@to_user',array($widget_token))}}</pre>


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