{!! Form::open(array('method' => 'post', 'url'=> URL::to('api/login'), 'files' => true, 'class' => 'form-horizontal')) !!}

{!! Form::text('email', Input::old('email'), array('class'=>'form-control')) !!}
{!! Form::text('password', Input::old('password'), array('class'=>'form-control')) !!}

<input type="submit" value="Enviar" />
{!! Form::close() !!}