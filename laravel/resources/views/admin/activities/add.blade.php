@extends('admin.template')

@section('title')
	Agregar Actividad
@endsection

@section('content')

<div class="page-header">
	<h2>Agregar Actividad</h2>
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
		{!! Form::text('title', Input::old('title'), array('class'=>'form-control')) !!}
		@if($errors->has('title'))
		<div class="error"><small>El título debe tener al menos 5 caracteres</small></div>
		@endif
	</div>
</div>

<div class="form-group">
	{!! Form::label('description', 'Descripción', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::textarea('description', Input::old('description'), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('address', 'Dirección', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('address', Input::old('address'), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('date_from', 'Desde', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		<div class='input-group date datetimepicker'>
			{!! Form::text('date_from', Input::old('date_from'), array('class'=>'form-control')) !!}
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
	</div>
</div>

<div class="form-group">
	{!! Form::label('date_to', 'Hasta', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		<div class='input-group date datetimepicker'>
			{!! Form::text('date_to', Input::old('date_to'), array('class'=>'form-control')) !!}
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
	</div>
</div>

<!--
<div class="form-group">
	{!! Form::label('range', 'Horario', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('date', Input::old('range', 12,14), array('class'=>'form-control slider', 'data-slider-min'=>0, 'data-slider-max'=>48, 'data-slider-step'=>'1', 'data-slider-value'=>'[0, 48]')) !!}
		<span class="slider-value" style="padding-left:30px;"></span>
	</div>
</div>
-->

<div class="form-group">
	{!! Form::label('type', 'Tipo', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::select('type', $types, Input::old('type'), array('class'=>'form-control')) !!}
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
		{!! Form::hidden('latitude',  Input::old('type', 19.4301553)); !!}
		{!! Form::hidden('longitude', Input::old('type', -99.1950621)); !!}
		{!! Form::label('geocomplete', 'Buscar punto geográfico', array('class' => 'control-label')) !!}
		{!! Form::text('geocomplete', '', array('class'=>'form-control', 'placeholder'=>'Escribe una dirección')) !!}
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