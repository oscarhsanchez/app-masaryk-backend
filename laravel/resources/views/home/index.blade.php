<!DOCTYPE HTML>
<html lang="en-GB">
<head>

    <meta charset="UTF-8" />
    <title>Camina Masaryk | Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    {!! HTML::style('assets/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/css/admin.css') !!}
    {!! HTML::script('assets/js/jquery.min.js') !!}
    {!! HTML::script('assets/js/jquery.bootstrap.min.js') !!}
    
</head>
<body>
	<div class="jumbotron vertical-center">
		<div class="container">
			<div class="col-sm-6 col-sm-offset-4  panel panel-default">		
				<div class="panel-body">	
					{!! Form::open() !!}
						
						@if (Session::has('login_errors'))
						<div class="alert alert-danger" role="alert">Usuario o contraseña incorrecta</div>
						@endif
						
						<div class="form-horizontal">
							<div class="form-group">
								{!! Form::label('username', 'Usuario', array("class"=>"control-label col-xs-4")) !!}
								<div class="col-xs-8">
									{!! Form::text('username', Input::old('username', 'tangamampilia@gmail.com'), array("class"=>"form-control")) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('password', 'Contraseña', array("class"=>"control-label col-xs-4")) !!}
								<div class="col-xs-8">
									{!! Form::password('password', array("class"=>"form-control")) !!}
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-offset-4 col-xs-8">
									<button type="submit" class="btn btn-info">
										<span class="glyphicon glyphicon-record"></span> Ingresar
									</button>
								</div>
							</div>
						</div>
						
					{!! Form::close() !!}
				</div>
				
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			window.scrollTo(0,1);
		})
	</script>
</body>
</html>