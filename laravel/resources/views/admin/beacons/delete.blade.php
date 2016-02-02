@extends('admin.template')

@section('title')
Eliminar Beacon
@endsection

@section('content')

<div class="page-header">
	<h2>Eliminar Beacon</h2>
</div>


<div class="form-group">
	¿Deseas eliminar el contenido <i>"{{ $data }}"</i>?
</div>
<div class="form-group">
{!! Form::open() !!}
	<input type="submit" value="Eliminar"  class="btn btn-danger" />
	<a href="{{ URL::to("admin/beacons") }}" class="btn btn-default">Cancelar</a>
{!! Form::close() !!}
</div>
@endsection

