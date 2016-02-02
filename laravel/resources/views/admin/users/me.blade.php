@extends('admin.template')

@section('title')
	Perfil
@endsection

@section('content')

<div class="page-header">
	<h2>Perfil</h2>
</div>

@if (Session::get('message') || Session::get('error'))
	<div class="alert alert-{!! Session::get('message') ? 'success' : 'error' !!} alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul class="status"><li>{{ Session::get('message') }}</li></ul>
	</div>
@endif

{!! Form::open(array('method' => 'post', 'files' => true, 'class' => 'form-horizontal')) !!}

<div class="form-group">
	{!! Form::label('email', 'Correo', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('email', Input::old('email', $data->email), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('password', 'Contraseña', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::password('password', array('class'=>'form-control')) !!}
		@if($errors->has('password'))
		<div class="error">La contraseña debe contener al menos 6 caracteres</div>
		@endif
	</div>
</div>

<div class="form-group">
	{!! Form::label('cpassword', 'Confirmar', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::password('cpassword', array('class'=>'form-control')) !!}
		@if($errors->has('cpassword'))
		<div class="error">La contraseña debe contener al menos 6 caracteres</div>
		@endif
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-info">
			<span class="glyphicon glyphicon-saved"></span> Guardar
		</button>
	</div>
</div>
  
{!! Form::close() !!}

@endsection