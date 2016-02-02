@extends('admin.template')

@section('title')
	Editar Usuario
@endsection

@section('content')

<div class="page-header">
	<h2>Editar Usuario</h2>
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
		@if($errors->has('email'))
		<div class="error">El correo ya está registrado o no tiene un formato correcto</div>
		@endif
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
	{!! Form::label('first_name', 'Nombre', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('first_name', Input::old('first_name', $data->first_name), array('class'=>'form-control')) !!}
		@if($errors->has('first_name'))
		<div class="error">El nombre debe tener entre 3 a 50 caracteres</div>
		@endif
	</div>
</div>

<div class="form-group">
	{!! Form::label('last_name', 'Apellidos', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('last_name', Input::old('last_name', $data->last_name), array('class'=>'form-control')) !!}
		@if($errors->has('last_name'))
		<div class="error">Los apellidos deben tener entre 3 a 50 caracteres</div>
		@endif
	</div>
</div>

<div class="form-group">
	{!! Form::label('city', 'Ciudad', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('city', Input::old('city', $data->city), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('birthday', 'Nacimiento', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		<div class='input-group date datetimepicker'>
			{!! Form::text('birthday', Input::old('birthday', $data->birthday), array('class'=>'form-control')) !!}
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
	</div>
</div>

<div class="form-group">
	{!! Form::label('phone', 'Teléfono', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('phone', Input::old('phone', $data->phone), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('disabled', 'Activo', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::checkbox('disabled', '0', Input::old('disabled', $data->disabled) == 0, array('class'=>'form-control')) !!}
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

<script type="text/javascript">

	jQuery(document).ready(function(){		
		$('.datetimepicker').datetimepicker({defaultDate:"moment", format:"YYYY-MM-DD"});
	})

</script>

@endsection