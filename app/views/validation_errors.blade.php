<?php $val_errors=  isset($validator) ? $validator->messages() : null; ?>

@if(count($val_errors) > 0)
<div class="alert alert-notify">
	<strong>There were validation errors! Please correct:</strong><br>
	<ul>
	@foreach($val_errors as $val_error)
		<li>{{$val_error}}</li>
	@endforeach
	</ul>
</div>
@endif