@extends('layouts.principal')

@section('content')
	<div class="row">
		<div class="col-md-12 text-center">
	    	<h2 class="title">¡Bienvenido!</h2>
	    	<h4 class="subtitle">Realiza una búsqueda para encontrar los datos y el historial de tu cliente</h4>
	    	<p>Recuerda que si tu cliente es nuevo, deberás realizar el registro completo</p>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-12">
	    	<h4 class="subtitle">Customer Search</h4>
	    	<p>Utiliza los filtros para encontrar al cliente con mayor facilidad</p>
	    </div>
	    <div class="col-md-12">
	    	{!! Form::model(Request::all()) !!}
		    	<div class="row">
		    		<div class="form-group col-md-6">
		    			{!! Form::text('name', null, ['id' => 'search-name', 'class' => 'form-control', 'placeholder' => 'Nombre, Apellido o Razón Social']) !!}
		    		</div>
		    		<div class="form-group col-md-6">
		    			{!! Form::text('rfc', null, ['id' => 'search-rfc', 'class' => 'form-control', 'placeholder' => 'RFC']) !!}
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-8">
		    			{!! Form::text('address', null, ['id' => 'search-address', 'class' => 'form-control', 'placeholder' => 'Dirección']) !!}
		    		</div>
		    		<div class="form-group col-md-4">
		    			{!! Form::text('contact', null, ['id' => 'search-contact', 'class' => 'form-control', 'placeholder' => 'Teléfono, Móvil o Correo Electrónico']) !!}
		    		</div>
		    	</div>
	    	{!! Form::close() !!}
	    </div>
	</div>
@endsection
@section('table-result')
		<div class="row">
			<div class="col-md-3">
	    		<h4 class="subtitle">Coincidencias encontradas</h4>
	    		<p class="float-left">Viendo {!! $masters->firstItem() !!} a {!! $masters->lastItem() !!} de {!! $masters->total() !!} clientes</p>
	    	</div>
			<div class="col-md-9 text-right">
		    	{!! $masters->render() !!}
		    </div>
			<div class="col-md-12">
		    	<div class="table-responsive">
			        <table class="table table-striped table-hover">
				        <thead>
				            <tr>
				                <th class="text-center">Nombre</th>
				                <th class="text-center">RFC</th>
				                <th class="text-center">Acciones</th>
				            </tr>
				        </thead>
				        <tbody>
				        	@foreach($masters as $master)
					        	<tr>
					        		<td class="text-center">{!! $master->social_reason !!}</td>
					        		<td class="text-center">{!! $master->rfc !!}</td>
					        		<td class="text-center" style="min-width: 250px;">
					        			<button class="btn btn-primary">Ver</button>
					        			{!! link_to('/', $title = 'Documentar', $parameters = ['class'=>'btn btn-primary'], $attributes = []) !!}
					        		</td>
					        	</tr>
							@endforeach
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
@endsection
@section('scripts')
	{!!Html::script('js/customer-search.js')!!}
@endsection