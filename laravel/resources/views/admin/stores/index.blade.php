@extends('admin.template')

@section('title')
	Locales
@endsection

@section('content')

<?PHP $order_url = preg_replace('/(?:&|(\?))' . "order" . '=[^&]*(?(1)&|)?/i', '$1', $_SERVER['QUERY_STRING']); ?>

<div class="page-header">
	<h2>Locales</h2>
</div>

@if (Session::get('message'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul class="status"><li>{!! Session::get('message') !!}</li></ul>
	</div>
@endif

{!! Form::open(array("method"=>'GET', 'class'=>'form-inline')) !!}
	<div class="row">
		<div class="col-xs-6">
			{!! Pagination::limit($limit) !!}
		</div>
		<div class="col-xs-6">
			<div class="pull-right">
			{!! Pagination::search($search) !!}
			</div>
		</div>
	</div>
{!! Form::close() !!}

<div class="panel panel-default"> 

	<div class="panel-body">
		<table class="table table-condensed table-striped table-hover">
		<thead>
			<tr>
				<th class="avatar"></th>
				<th>Título</th>
				<th>Dirección</th>
				<th>Teléfono</th>
				<th>Tipo</th>
				<th class="short-column">Activo</th>
				<th class="action"></th>
			</tr>
		</thead>
		<tbody>
		@foreach ($rows as $x => $row)
			<tr class="{!! $x++%2==0?'odd':'even' !!}  @if ( $row->active == 0 ) text-muted @endif">
				<td><span class="avatar"><img src="{!! $row->crop(50, 50) !!}?r={!! rand() !!}" alt="{!! $row->title !!}"/></span></td>
				<td>{!! $row->title !!}</td>
				<td>{!! strlen($row->address) > 50 ? (substr($row->address, 0, 50)."...") : $row->address !!}</td>
				<td>{!! $row->phone !!}</td>
				<td>{!! $row->type ? $row->type->name : 'N/A' !!}</td>
				<td class="short-column"> 
					@if ($row->active == 1)
					Si @else No @endif
				</td>
				<td class="action text-right">
					<a href='{!! URL::to('admin/stores/edit/'.$row->id) !!}' class='btn btn-success'><span class="glyphicon glyphicon-pencil"></span><!-- Editar --></a>
					<a href='{!! URL::to('admin/stores/delete/'.$row->id) !!}' class='btn btn-danger'><span class="glyphicon glyphicon-remove"></span><!-- Eliminar --></a>
				</td>
			</tr>
	    @endforeach			
		</tbody>	
		</table>
	</div>
	
	 <div class="panel-footer">
 		<div class="row">
 			 <div class="col-xs-6">{!! Pagination::show(($page) * $limit + 1, $show, $total) !!}</div>
 			 <div class="col-xs-6"><nav class="pull-right">{!! Pagination::links($page, $total, $limit) !!}</nav></div>
 		</div>
	 </div>

	
</div>




@endsection