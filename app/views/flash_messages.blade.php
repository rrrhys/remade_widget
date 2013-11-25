<?php $success = Session::get('success'); ?>
@if ($success)
<div class='alert alert-success'>
	{{$success}}
</div>
@endif


<?php $error = Session::get('error'); ?>
@if ($error)
<div class='alert alert-danger'>
	{{$error}}
</div>
@endif