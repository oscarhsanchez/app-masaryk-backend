@extends('admin.template')

@section('title')
Eliminar Promoción
@endsection

@section('content')

<div class="page-header">
	<h2>Eliminar Promoción</h2>
</div>


<div class="form-group">
	¿Deseas eliminar el contenido <i>"{{ $data }}"</i>?
</div>
<div class="form-group">
{!! Form::open() !!}
	<input type="submit" value="Eliminar"  class="btn btn-danger" />
	<a href="{{ URL::to("admin/promos") }}" class="btn btn-default">Cancelar</a>
{!! Form::close() !!}
</div>
@endsection

