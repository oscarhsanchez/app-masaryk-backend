<!DOCTYPE HTML>
<html lang="es-MX">
<head>
    <meta charset="UTF-8" />
    <title>
    	Camina Masaryk | @yield('title')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,400italic' rel='stylesheet' type='text/css'>
        
    <script type="text/javascript">var URL = {to:function($url){return "{!! URL::to("") !!}" + "/" + $url}}</script>
    
    {!! HTML::style('assets/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/css/bootstrap-datetimepicker.min.css') !!}
    {!! HTML::style('assets/css/jquery.chosen.min.css') !!}
    {!! HTML::style('assets/css/admin.css') !!}    
        
	{!! HTML::script('http://maps.googleapis.com/maps/api/js?key=AIzaSyDeFu5Xkl9Do1Ty2UqWX8MfHyyuqV45OHY&amp;libraries=places') !!}
	{!! HTML::script('https://www.google.com/jsapi ') !!} 
	{!! HTML::script('assets/js/modernizr.js') !!}
	{!! HTML::script('assets/js/moment.min.js') !!}   
    {!! HTML::script('assets/js/jquery.min.js') !!}
    {!! HTML::script('assets/js/jquery.geocomplete.min.js') !!}
    {!! HTML::script('assets/js/jquery.chosen.min.js') !!}
    {!! HTML::script('assets/js/jquery.bootstrap.min.js') !!} 
    {!! HTML::script('assets/js/jquery.bootstrap.datetimepicker.js') !!} 
    {!! HTML::script('assets/js/jquery.admin.js') !!}
                
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Camina Masaryk</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown {!! Request::is('admin/promos*') ? 'active' : '' !!}">
						<a href="{!! URL::to('admin/promos') !!}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-tags"></span> Promociones <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{!! URL::to('admin/promos') !!}">Listado</a></li>
							<li><a href="{!! URL::to('admin/promos/add') !!}">Agregar</a></li>
						</ul>
					</li>
					<li class="dropdown {!! Request::is('admin/stores*') ? 'active' : '' !!}">
						<a href="{!! URL::to('admin/stores') !!}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-map-marker"></span> Locales <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{!! URL::to('admin/stores') !!}">Listado</a></li>
							<li><a href="{!! URL::to('admin/stores/add') !!}">Agregar</a></li>
						</ul>
					</li>
					<li class="dropdown {!! Request::is('admin/activities*') ? 'active' : '' !!}">
						<a href="{!! URL::to('admin/activities') !!}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-time"></span> Actividades <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{!! URL::to('admin/activities') !!}">Listado</a></li>
							<li><a href="{!! URL::to('admin/activities/add') !!}">Agregar</a></li>
						</ul>
					</li>
					<li class="dropdown {!! Request::is('admin/beacons*') ? 'active' : '' !!}">
						<a href="{!! URL::to('admin/beacons') !!}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-bell"></span> Beacons <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{!! URL::to('admin/beacons') !!}">Listado</a></li>
							<li><a href="{!! URL::to('admin/beacons/add') !!}">Agregar</a></li>
						</ul>
					</li>
					<li class="{!! Request::is('admin/users') ? 'active' : '' !!}"><a href="{!! URL::to('admin/users') !!}"><span class="glyphicon glyphicon-user"></span> Usuarios</a></li>
					<li class="{!! Request::is('admin/users/me') ? 'active' : '' !!}"><a href="{!! URL::to('admin/users/me') !!}"><span class="glyphicon glyphicon-star"></span> Perfil</a></li>
					<li><a href="{!! URL::to('logout') !!}"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
				</ul>
			</div>
		</div>
	</nav>	
	<div id="content" class="container">
		@yield('content')
	</div>
</body>
</html>