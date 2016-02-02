@extends('admin.template')

@section('title')
	Agregar Beacon
@endsection

@section('content')

<div class="page-header">
	<h2>Agregar Beacon</h2>
</div>

@if (Session::get('message') || Session::get('error'))
	<div class="alert alert-{!! Session::get('message') ? 'success' : 'error' !!} alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul class="status"><li>{{ Session::get('message') }}</li></ul>
	</div>
@endif

{!! Form::open(array('method' => 'post', 'files' => true, 'class' => 'form-horizontal')) !!}

<div class="form-group">
	{!! Form::label('uuid', 'UUID', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('uuid', Input::old('uuid'), array('class'=>'form-control')) !!}
		@if($errors->has('uuid'))
		<div class="error"><small>El UUID debe tener al menos 10 caracteres</small></div>
		@endif
	</div>
</div>

<div class="form-group">
	{!! Form::label('active', 'Activo', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::checkbox('active', '1', Input::old('active', 1) == 1, array('class'=>'form-control')) !!}
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