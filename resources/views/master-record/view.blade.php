@extends('layouts.principal')

@section('content')
		<div class="row">
			<div class="col-md-12">
		    	<h2 class="title">Registro Maestro</h2>
		    	<h4 class="subtitle">Cliente existente</h4>
		    </div>
			<div class="col-md-12">
		    	<h4 class="subtitle">Compañía</h4>
		    </div>
		    <div class="col-md-12">
		    	<div class="table-responsive">
		    		<table class="table table-hover table-bordered table-striped">
		    			<tbody>
		    				<tr>
		    					<td><b>Nombre o Razón Social</b></td>
		    					<td>{!! $master->social_reason !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>RFC</b></td>
		    					<td>{!! $master->rfc !!}</td>
		    				</tr>
		    			</tbody>
		    		</table>
		    	</div>
		    </div>
			<div class="col-md-12">
		    	<h4 class="subtitle">Sucursal</h4>
		    </div>
		    <div class="col-md-12">
		    	<div class="table-responsive">
		    		<table class="table table-hover table-bordered table-striped">
		    			<tbody>
		    				<tr>
		    					<td><b>ID</b></td>
		    					<td>{!! $branch->id_unique_customer !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Descripción</b></td>
		    					<td>{!! $branch->branch_description !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Calle</b></td>
		    					<td>{!! $branch->street !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>No. Exterior</b></td>
		    					<td>{!! $branch->no_ext !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>No. Interior</b></td>
		    					<td>{!! $branch->no_int !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Colonia</b></td>
		    					<td>{!! $branch->colony !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Estado</b></td>
		    					<td>{!! $branch->state !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Ciudad</b></td>
		    					<td>{!! $branch->city !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>País</b></td>
		    					<td>{!! $branch->country !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Código Postal</b></td>
		    					<td>{!! $branch->postal_code !!}</td>
		    				</tr>
		    			</tbody>
		    		</table>
		    	</div>
		    </div>
			<div class="col-md-12">
		    	<h4 class="subtitle">Contactos</h4>
		    </div>
		    <div class="col-md-12">
		    	<div class="table-responsive">
		    		<table class="table table-hover table-bordered table-striped">
		    			<thead>
		    				<tr>
		    					<th>Tipo</th>
		    					<th>Descripción</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    				@foreach($contacts as $contact)
			    				<tr>
			    					<td><b>{!! $contact->type !!}</b></td>
			    					<td>{!! $contact->description !!}</td>
			    				</tr>
		    				@endforeach
		    			</tbody>
		    		</table>
		    	</div>
		    </div>
		    <div class="col-md-12">
		    	<hr>
		    </div>
		    <div class="col-md-12 text-right btn-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				{!!link_to_route('master-record.edit', $title = "Editar", $parameters = $branch->id, $attributes = ['class' => 'btn btn-secondary'])!!}
		    	<button class="btn btn-primary" id="seleccionar">Documentar</button>
		    </div>
@endsection