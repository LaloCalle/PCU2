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
	{!! Form::open() !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('social_reason', null, ['id' => 'create-social_reason', 'class' => 'form-control', 'placeholder' => 'Nombre o Razón Social']) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::text('rfc', null, ['id' => 'create-rfc', 'class' => 'form-control', 'placeholder' => 'RFC']) !!}
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
	{!! Form::open() !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-12">
	    			{!! Form::text('branch_description', null, ['id' => 'create-branch_description', 'class' => 'form-control', 'placeholder' => 'Descripción']) !!}
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::select('country', $countries, null, ['id' => 'create-country', 'class' => 'form-control', 'placeholder' => 'País']) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::select('city', $cities, null, ['id' => 'create-city', 'class' => 'form-control', 'placeholder' => 'Ciudad']) !!}
	    		</div>
		    </div>
	    	<div class="row" id="postal_codes_other">
	    		<div class="form-group col-md-4">
	    			{!! Form::text('postal_code', null, ['id' => 'create-postal_code', 'class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
	    		</div>
	    		<div class="form-group col-md-4">
	    			{!! Form::text('colony', null, ['id' => 'create-colony', 'class' => 'form-control', 'placeholder' => 'Colonia']) !!}
	    		</div>
	    		<div class="form-group col-md-4">
	    			{!! Form::text('state', null, ['id' => 'create-state', 'class' => 'form-control', 'placeholder' => 'Estado']) !!}
	    		</div>
	    	</div>
	    	<div class="row" id="postal_codes_mx" style="display: none;">
				<div class="form-group col-md-4">
					{!! Form::text('postal_code', null, ['id' => 'create-postal_code_mx', 'class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
				</div>
				<div class="form-group col-md-4">
					{!! Form::select('colony', [], null, ['id' => 'create-colony_mx', 'class' => 'form-control', 'placeholder' => 'Colonia']) !!}
				</div>
				<div class="form-group col-md-4">
					{!! Form::text('state', null, ['id' => 'create-state_mx', 'class' => 'form-control', 'placeholder' => 'Estado', 'disabled']) !!}
				</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('street', null, ['id' => 'create-street', 'class' => 'form-control', 'placeholder' => 'Calle']) !!}
	    		</div>
	    		<div class="form-group col-md-3">
	    			{!! Form::text('no_ext', null, ['id' => 'create-no_ext', 'class' => 'form-control', 'placeholder' => 'No. Exterior']) !!}
	    		</div>
	    		<div class="form-group col-md-3">
	    			{!! Form::text('no_int', null, ['id' => 'create-no_int', 'class' => 'form-control', 'placeholder' => 'No. Interior']) !!}
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
	{!! Form::open() !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('email', null, ['id' => 'create-email', 'class' => 'form-control', 'placeholder' => 'E-mail']) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::text('phone', null, ['id' => 'create-phone', 'class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('mobile', null, ['id' => 'create-mobile', 'class' => 'form-control', 'placeholder' => 'Móvil']) !!}
	    		</div>
	    		<div class="form-group col-md-6">
					{!! Form::text('other', null, ['id' => 'create-other', 'class' => 'form-control', 'placeholder' => 'Otro']) !!}
	    		</div>
	    	</div>
	    </fieldset>
    {!! Form::close() !!}
</div>
<div class="col-md-12">
	<hr>
</div>