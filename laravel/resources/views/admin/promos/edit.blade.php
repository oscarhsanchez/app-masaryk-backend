@extends('admin.template')

@section('title')
	Editar Promoción
@endsection

@section('content')

<div class="page-header">
	<h2>Editar Promoción</h2>
</div>

@if (Session::get('message') || Session::get('error'))
	<div class="alert alert-{!! Session::get('message') ? 'success' : 'error' !!} alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul class="status"><li>{{ Session::get('message') }}</li></ul>
	</div>
@endif

{!! Form::open(array('method' => 'post', 'files' => true, 'class' => 'form-horizontal')) !!}

<div class="form-group">
	{!! Form::label('title', 'Título', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('title', Input::old('title', $data->title), array('class'=>'form-control')) !!}
		@if($errors->has('title'))
		<div class="error"><small>El título debe tener al menos 5 caracteres</small></div>
		@endif
	</div>
</div>

<div class="form-group">
	{!! Form::label('store', 'Local', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::select('store', $stores, Input::old('store', $data->store_id), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('beacon', 'Beacon', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::select('beacon', $beacons, Input::old('beacon', $data->beacon_id), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('image', 'Imagen', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::file('image', array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('active', 'Activo', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::checkbox('active', '1', Input::old('active', $data->active) == 1, array('class'=>'form-control')) !!}
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