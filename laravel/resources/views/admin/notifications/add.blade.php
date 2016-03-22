@extends('admin.template')

@section('title')
	Agregar Notificación
@endsection

@section('content')

<div class="page-header">
	<h2>Agregar Notificación</h2>
</div>

@if (Session::get('message') || Session::get('error'))
	<div class="alert alert-{!! Session::get('message') ? 'success' : 'error' !!} alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul class="status"><li>{{ Session::get('message') }}</li></ul>
	</div>
@endif

{!! Form::open(array('method' => 'post', 'files' => true, 'class' => 'form-horizontal')) !!}

<div class="form-group">
	{!! Form::label('message', 'Mensaje', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('message', Input::old('message'), array('class'=>'form-control')) !!}
		@if($errors->has('message'))
		<div class="error"><small>El título debe tener entre 10 a 100 caracteres</small></div>
		@endif
	</div>
</div>

<div class="form-group">
	{!! Form::label('scheduled', 'Fecha', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		<div class='input-group date datetimepicker'>
			{!! Form::text('scheduled', Input::old('scheduled'), array('class'=>'form-control')) !!}
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
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