@extends('layouts.principal')

@section('content')
	<div class="row">
		<div class="col-md-12">
	    	<h2 class="title">Registro Maestro</h2>
	    </div>
	    <div class="col-md-12">
	    	<p>Edita el registro maestro</p>
	    	<h4 class="subtitle">Cliente existente</h4>
	    </div>
			<div class="col-md-12">
		    	<h4 class="subtitle">Compañía</h4>
		    </div>
		    <div class="col-md-12">
			    <input type="hidden" name="id_master" id="id_master" value="{!! $master->id !!}"></input>
		    	<div class="table-responsive">
		    		<table class="table table-hover table-bordered table-striped">
		    			<tbody>
		    				<tr>
		    					<td><b>Nombre o Razón Social</b></td>
		    					<td><input type="hidden" name="social_reason" id="social_reason" value="{!! $master->social_reason !!}"></input>{!! $master->social_reason !!}</td>
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
	    	<hr>
	    </div>
		<div class="col-md-12">
	    	<h4 class="subtitle">Sucursales</h4>
	    </div>
	    <div class="col-md-12">
	    	<div class="table-responsive">
	    		<table class="table table-hover table-bordered table-striped">
	    			<thead>
	    				<tr>
	    					<th>ID</th>
	    					<th>Sucursal</th>
	    					<th>Acciones</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach($branches as $branch)
		    				<tr>
		    					<td>{!! $branch->id_unique_customer !!}</td>
		    					<td>{!! $branch->branch_description !!}</td>
		    					<td class="text-center" style="min-width: 250px;">
		    						<button class="btn btn-primary">Editar</button>
		    						<button class="btn btn-primary">Eliminar</button>
				        		</td>
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
			<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addBranch">Agregar Sucursal</button>
	    </div>
	</div>

	<div class="modal fade" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Agregar sucursal: {!! $master->social_reason !!}</h4>
	      </div>
	      <div class="modal-body">
			@include('alerts.modal')
		    <h4 class="subtitle">Sucursal</h4>
	        {!! Form::open() !!}
		    	<fieldset>
			    	<div class="row">
			    		<div class="form-group col-md-12">
			    			<input type="hidden" name="id_branch" id="id_branch" value="{!! $branch->id !!}"></input>
			    			{!! Form::text('branch_description', null, ['id' => 'link-branch_description', 'class' => 'form-control', 'placeholder' => 'Descripción']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
			    			{!! Form::select('country', $countries, null, ['id' => 'link-country', 'class' => 'form-control', 'placeholder' => 'País']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
			    			{!! Form::select('city', $cities, null, ['id' => 'link-city', 'class' => 'form-control', 'placeholder' => 'Ciudad']) !!}
			    		</div>
			    		<div class="form-group col-md-4">
			    			{!! Form::text('postal_code', null, ['id' => 'link-postal_code', 'class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
			    		</div>
			    		<div class="form-group col-md-4">
			    			{!! Form::text('colony', null, ['id' => 'link-colony', 'class' => 'form-control', 'placeholder' => 'Colonia']) !!}
			    		</div>
			    		<div class="form-group col-md-4">
			    			{!! Form::text('state', null, ['id' => 'link-state', 'class' => 'form-control', 'placeholder' => 'Estado']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
			    			{!! Form::text('street', null, ['id' => 'link-street', 'class' => 'form-control', 'placeholder' => 'Calle']) !!}
			    		</div>
			    		<div class="form-group col-md-3">
			    			{!! Form::text('no_ext', null, ['id' => 'link-no_ext', 'class' => 'form-control', 'placeholder' => 'No. Exterior']) !!}
			    		</div>
			    		<div class="form-group col-md-3">
			    			{!! Form::text('no_int', null, ['id' => 'link-no_int', 'class' => 'form-control', 'placeholder' => 'No. Interior']) !!}
			    		</div>
			    	</div>
			    </fieldset>
		    {!! Form::close() !!}
	    	<hr>
	    	<h4 class="subtitle">Contactos</h4>
	        {!! Form::open() !!}
			    <fieldset>
			    	<div class="row">
			    		<div class="form-group col-md-6">
			    			{!! Form::text('email', null, ['id' => 'link-email', 'class' => 'form-control', 'placeholder' => 'E-mail']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
			    			{!! Form::text('phone', null, ['id' => 'link-phone', 'class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
			    			{!! Form::text('mobile', null, ['id' => 'link-mobile', 'class' => 'form-control', 'placeholder' => 'Móvil']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
							{!! Form::text('other', null, ['id' => 'link-other', 'class' => 'form-control', 'placeholder' => 'Otro']) !!}
			    		</div>
			    	</div>
			    </fieldset>
		    {!! Form::close() !!}
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" id="link-add-branch">Agregar</button>
	      </div>
	    </div>
	  </div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/possible-match-link.js')!!}
@endsection