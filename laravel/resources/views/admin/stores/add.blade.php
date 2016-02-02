@extends('admin.template')

@section('title')
	Agregar Local
@endsection

@section('content')

<div class="page-header">
	<h2>Agregar Local</h2>
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
	{!! Form::label('address', 'Dirección', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('address', Input::old('address'), array('class'=>'form-control')) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('phone', 'Teléfono', array('class' => 'col-sm-2 control-label')) !!}
	<div class="col-sm-10">
		{!! Form::text('phone', Input::old('phone'), array('class'=>'form-control')) !!}
	</div>
</div>

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
		
	})

</script>

@endsection