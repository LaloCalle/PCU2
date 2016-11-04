@extends('layouts.principal')

@section('content')
	<div class="row">
		<div class="col-md-8">
	    	<h2 class="title">Registro Maestro</h2>
	    </div>
	    <div class="col-md-4 progressbar-complete">
	    	<div id="progressbar-complete"><div class="progress-label">{!! $porcentaje !!}%</div></div>
	    </div>
	    <div class="col-md-12">
	    	<p>Edita el registro maestro</p>
	    	<h4 class="subtitle">Cliente existente</h4>
	    </div>
		<div class="col-md-12">
	    	<h4 class="subtitle">Compañía</h4>
	    </div>
	    <div class="col-md-12">
	    	{!! Form::model($master) !!}
		    	<fieldset>
			    	<div class="row">
			    		<div class="form-group col-md-6">
			    			<input type="hidden" name="id_master" id="id_master" value="{!! $master->id !!}"></input>
			    			{!! Form::text('social_reason', null, ['id' => 'complete-social_reason', 'class' => 'form-control', 'placeholder' => 'Nombre o Razón Social']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
			    			{!! Form::text('rfc', null, ['id' => 'complete-rfc', 'class' => 'form-control', 'placeholder' => 'RFC']) !!}
			    		</div>
			    	</div>
			    </fieldset>
		    {!! Form::close() !!}
		</div>
	    <div class="col-md-12">
	    	<hr>
	    </div>
		<div class="col-md-12">
	    	<h4 class="subtitle">Sucursal</h4>
	    </div>
	    <div class="col-md-12">
	    	{!! Form::model($branch) !!}
		    	<fieldset>
			    	<div class="row">
			    		<div class="form-group col-md-6">
			    			<input type="hidden" name="id_branch" id="id_branch" value="{!! $branch->id !!}"></input>
			    			{!! Form::text('id_unique_customer', null, ['id' => 'complete-id_unique_customer', 'class' => 'form-control', 'placeholder' => 'ID Cliente Único', 'disabled']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
			    			{!! Form::text('branch_description', null, ['id' => 'complete-branch_description', 'class' => 'form-control', 'placeholder' => 'Descripción']) !!}
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="form-group col-md-6">
			    			{!! Form::select('country', $countries, null, ['id' => 'complete-country', 'class' => 'form-control', 'placeholder' => 'País']) !!}
			    		</div>
			    		<div class="form-group col-md-6">
			    			{!! Form::select('city', $cities, null, ['id' => 'complete-city', 'class' => 'form-control', 'placeholder' => 'Ciudad']) !!}
			    		</div>
				    </div>
			    	<div class="row">
			    		<div class="form-group col-md-4">
			    			{!! Form::text('postal_code', null, ['id' => 'complete-postal_code', 'class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
			    		</div>
			    		<div class="form-group col-md-4">
			    			{!! Form::text('colony', null, ['id' => 'complete-colony', 'class' => 'form-control', 'placeholder' => 'Colonia']) !!}
			    		</div>
			    		<div class="form-group col-md-4">
			    			{!! Form::text('state', null, ['id' => 'complete-state', 'class' => 'form-control', 'placeholder' => 'Estado']) !!}
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="form-group col-md-6">
			    			{!! Form::text('street', null, ['id' => 'complete-street', 'class' => 'form-control', 'placeholder' => 'Calle']) !!}
			    		</div>
			    		<div class="form-group col-md-3">
			    			{!! Form::text('no_ext', null, ['id' => 'complete-no_ext', 'class' => 'form-control', 'placeholder' => 'No. Exterior']) !!}
			    		</div>
			    		<div class="form-group col-md-3">
			    			{!! Form::text('no_int', null, ['id' => 'complete-no_int', 'class' => 'form-control', 'placeholder' => 'No. Interior']) !!}
			    		</div>
			    	</div>
			    </fieldset>
		    {!! Form::close() !!}
		</div>
	    <div class="col-md-12">
	    	<hr>
	    </div>
		<div class="col-md-12">
	    	<h4 class="subtitle">Contactos</h4>
	    </div>
	    <div class="col-md-12">
	    	{!! Form::model($contacts) !!}
		    	<fieldset>
			    	<div class="row">
			    		<div class="form-group col-md-6">
			    			@if($contacts->count() == 0)
								{!! Form::text('email', null, ['id' => 'complete-email', 'class' => 'form-control', 'placeholder' => 'E-mail']) !!}
							@else
								<?php $controlador = 0; ?>
								@foreach($contacts as $contact)
									@if($contact->type == "email")
										{!! Form::text('email', $contact->description, ['id' => 'complete-email', 'class' => 'form-control', 'placeholder' => 'E-mail']) !!}
										<?php $controlador = 1; ?>
									@endif
								@endforeach
								@if($controlador == 0)
									{!! Form::text('email', null, ['id' => 'complete-email', 'class' => 'form-control', 'placeholder' => 'E-mail']) !!}
								@endif
							@endif
			    		</div>
			    		<div class="form-group col-md-6">
			    			@if($contacts->count() == 0)
								{!! Form::text('phone', null, ['id' => 'complete-phone', 'class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
							@else
								<?php $controlador = 0; ?>
								@foreach($contacts as $contact)
									@if($contact->type == "phone")
										{!! Form::text('phone', $contact->description, ['id' => 'complete-phone', 'class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
										<?php $controlador = 1; ?>
									@endif
								@endforeach
								@if($controlador == 0)
									{!! Form::text('phone', null, ['id' => 'complete-phone', 'class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
								@endif
							@endif
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="form-group col-md-6">
			    			@if($contacts->count() == 0)
								{!! Form::text('mobile', null, ['id' => 'complete-mobile', 'class' => 'form-control', 'placeholder' => 'Móvil']) !!}
							@else
								<?php $controlador = 0; ?>
								@foreach($contacts as $contact)
									@if($contact->type == "mobile")
										{!! Form::text('mobile', $contact->description, ['id' => 'complete-mobile', 'class' => 'form-control', 'placeholder' => 'Móvil']) !!}
										<?php $controlador = 1; ?>
									@endif
								@endforeach
								@if($controlador == 0)
									{!! Form::text('mobile', null, ['id' => 'complete-mobile', 'class' => 'form-control', 'placeholder' => 'Móvil']) !!}
								@endif
							@endif
			    		</div>
			    		<div class="form-group col-md-6">
							@if($contacts->count() == 0)
								{!! Form::text('other', null, ['id' => 'complete-other', 'class' => 'form-control', 'placeholder' => 'Otro']) !!}
							@else
								<?php $controlador = 0; ?>
								@foreach($contacts as $contact)
									@if($contact->type == "other")
										{!! Form::text('other', $contact->description, ['id' => 'complete-other', 'class' => 'form-control', 'placeholder' => 'Otro']) !!}
										<?php $controlador = 1; ?>
									@endif
								@endforeach
								@if($controlador == 0)
									{!! Form::text('other', null, ['id' => 'complete-other', 'class' => 'form-control', 'placeholder' => 'Otro']) !!}
								@endif
							@endif
			    		</div>
			    	</div>
			    </fieldset>
		    {!! Form::close() !!}
		</div>
	    <div class="col-md-12">
	    	<hr>
	    </div>
	    <div class="col-md-12 text-right btn-footer">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	    	<button class="btn btn-secondary" id="complete-update">Actualizar</button>
	    	<a href="{!! env('APP_ROUTE_VM') !!}/possible-match/{!! $master->id !!}/link" class="btn btn-primary">Link</a>
	    </div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/possible-match-edit.js')!!}
@endsection