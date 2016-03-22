@extends('admin.template')

@section('title')
	Usuarios
@endsection

@section('content')

<?PHP $order_url = preg_replace('/(?:&|(\?))' . "order" . '=[^&]*(?(1)&|)?/i', '$1', $_SERVER['QUERY_STRING']); ?>

<div class="page-header">
	<h2>Usuarios</h2>
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

	<div class="panel-body table-responsive">
		<table class="table table-condensed table-striped table-hover">
		<thead>
			<tr>
				<th class="avatar"></th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Correo</th>
				<th>Creado</th>
				<th class="col-md-1 text-center">Activo</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach ($rows as $x => $row)
			<tr class="{!! $x++%2==0?'odd':'even' !!}  @if ( $row->active == 0 ) text-muted @endif">
				<td><span class="avatar" style=""></span></td>
				<td>{!! $row->first_name == "" ? "--------" : $row->first_name !!}</td>
				<td>{!! $row->last_name  == "" ? "--------" : $row->last_name !!}</td>
				<td>{!! $row->email !!}</td>
				<td>{!! $row->created_at !!}</td>
				<td class="text-center"> 
					@if ($row->active == 1)
					Si @else No @endif
				</td>
				<td class="action">
					<a href='{!! URL::to('admin/users/edit/'.$row->id) !!}' class='btn btn-success'><span class="glyphicon glyphicon-pencil"></span></a>
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