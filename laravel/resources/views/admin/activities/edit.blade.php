@extends('admin.template')

@section('title')
	Editar Actividad
@endsection

@section('content')

<div class="page-header">
	<h2>Editar Actividad</h2>
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
	{!! Form::label('description', 'Descripción', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::textarea('description', Input::old('description', $data->description), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('address', 'Dirección', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('address', Input::old('address', $data->address), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('date_from', 'Desde', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		<div class='input-group date datetimepicker'>
			{!! Form::text('date_from', Input::old('date_from', $data->date_from), array('class'=>'form-control')) !!}
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
	</div>
</div>

<div class="form-group">
	{!! Form::label('date_to', 'Hasta', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		<div class='input-group date datetimepicker'>
			{!! Form::text('date_to', Input::old('date_to', $data->date_to), array('class'=>'form-control')) !!}
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
	</div>
</div>

<div class="form-group">
	{!! Form::label('type', 'Tipo', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::select('type', $types, Input::old('type', $data->type_id), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('image', 'Imagen', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::file('image', array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('maps', 'Ubicación', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		<div class="map_canvas" style="height:300px; margin-bottom:20px;"></div>
		{!! Form::hidden('latitude',  Input::old('latitude',  $data->lat)); !!}
		{!! Form::hidden('longitude', Input::old('longitude', $data->lng)); !!}
		{!! Form::label('geocomplete', 'Buscar punto geográfico', array('class' => 'control-label')) !!}
		{!! Form::text('geocomplete', '', array('class'=>'form-control', 'placeholder'=>'Escribe una dirección')) !!}
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

<script type="text/javascript">

	var map;
	var styles = [ { "stylers": [{"saturation":-100}, {"lightness":35}, {"gamma":0.63}] } ];

	jQuery(document).ready(function(){
	
		var lat = jQuery("input[name=latitude]").val();
		var lng = jQuery("input[name=longitude]").val();
		var location = new google.maps.LatLng(lat, lng);

		jQuery("input[name=latitude]").val(lat);
		jQuery("input[name=longitude]").val(lng);
		
		$("#geocomplete").geocomplete({
			map: ".map_canvas",
			details: "form",
			markerOptions: {
				draggable: true,
				position : location
			}
		});

		$("#geocomplete").bind("geocode:dragged", function(event, latLng){
			$("input[name=latitude]").val(latLng.lat());
			$("input[name=longitude]").val(latLng.lng());
		});
		
		map = $("#geocomplete").geocomplete("map");
		map.setCenter(location);
		map.setOptions({styles: styles});
		
		$('.datetimepicker').datetimepicker({defaultDate:"moment", format:"YYYY-MM-DD HH:mm"});
		
	})

</script>

@endsection