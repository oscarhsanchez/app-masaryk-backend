<p>
	Todos olvidamos nuestras contraseñas de vez en cuando, afortunadamente Camina Masaryk te puede generar una nueva para ti cuando lo necesites. Para crear una nueva contraseña por favor ingresa a esta liga o cópiala y pégala en tu navegador:
</p>
{!! Session::get('reset.password.email') !!}
<a href="{!! URL::to('api/code/?t='.$token.'&e='.Session::get('reset.password.email')) !!}">
	{!! URL::to('api/code/?t='.$token.'&e='.Session::get('reset.password.email')) !!}
</a>

<p>Una vez completado el proceso recibirás en tu correo una nueva contraseña. En caso de que no hayas solicitado un cambio por favor omite este correo</p>
