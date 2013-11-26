@extends('layout')

@section('title')
{{$user->email}}
@stop
@section('content')





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
	{{link_to_action('UserController@child_password_reset', 'Resend Activation Email',array('id'=>$child->id))}}
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
@stop