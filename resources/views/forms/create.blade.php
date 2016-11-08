<div class="col-md-12">
	<h2 class="title">{{ trans('strings.masterrecord') }}</h2>
</div>
<div class="col-md-12">
	<h4 class="subtitle">{{ trans('strings.company') }}</h4>
</div>
<div class="col-md-12">
	{!! Form::open() !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('social_reason', null, ['id' => 'create-social_reason', 'class' => 'form-control', 'placeholder' => trans('strings.namesocialreason')]) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::text('rfc', null, ['id' => 'create-rfc', 'class' => 'form-control', 'placeholder' => trans('strings.rfc')]) !!}
	    		</div>
	    	</div>
	    </fieldset>
    {!! Form::close() !!}
</div>
<div class="col-md-12">
	<hr>
</div>
<div class="col-md-12">
	<h4 class="subtitle">{{ trans('strings.branch') }}</h4>
</div>
<div class="col-md-12">
	{!! Form::open() !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-12">
	    			{!! Form::text('branch_description', null, ['id' => 'create-branch_description', 'class' => 'form-control', 'placeholder' => trans('strings.description')]) !!}
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::select('country', $countries, null, ['id' => 'create-country', 'class' => 'form-control', 'placeholder' => trans('strings.country')]) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::select('city', $cities, null, ['id' => 'create-city', 'class' => 'form-control', 'placeholder' => trans('strings.city')]) !!}
	    		</div>
		    </div>
	    	<div class="row" id="postal_codes_other">
	    		<div class="form-group col-md-4">
	    			{!! Form::text('postal_code', null, ['id' => 'create-postal_code', 'class' => 'form-control', 'placeholder' => trans('strings.postalcode')]) !!}
	    		</div>
	    		<div class="form-group col-md-4">
	    			{!! Form::text('colony', null, ['id' => 'create-colony', 'class' => 'form-control', 'placeholder' => trans('strings.colony')]) !!}
	    		</div>
	    		<div class="form-group col-md-4">
	    			{!! Form::text('state', null, ['id' => 'create-state', 'class' => 'form-control', 'placeholder' => trans('strings.state')]) !!}
	    		</div>
	    	</div>
	    	<div class="row" id="postal_codes_mx" style="display: none;">
				<div class="form-group col-md-4">
					{!! Form::text('postal_code', null, ['id' => 'create-postal_code_mx', 'class' => 'form-control', 'placeholder' => trans('strings.postalcode')]) !!}
				</div>
				<div class="form-group col-md-4">
					{!! Form::select('colony', [], null, ['id' => 'create-colony_mx', 'class' => 'form-control', 'placeholder' => trans('strings.colony')]) !!}
				</div>
				<div class="form-group col-md-4">
					{!! Form::text('state', null, ['id' => 'create-state_mx', 'class' => 'form-control', 'placeholder' => trans('strings.state'), 'disabled']) !!}
				</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('street', null, ['id' => 'create-street', 'class' => 'form-control', 'placeholder' => trans('strings.street')]) !!}
	    		</div>
	    		<div class="form-group col-md-3">
	    			{!! Form::text('no_ext', null, ['id' => 'create-no_ext', 'class' => 'form-control', 'placeholder' => trans('strings.noext')]) !!}
	    		</div>
	    		<div class="form-group col-md-3">
	    			{!! Form::text('no_int', null, ['id' => 'create-no_int', 'class' => 'form-control', 'placeholder' => trans('strings.noint')]) !!}
	    		</div>
	    	</div>
	    </fieldset>
    {!! Form::close() !!}
</div>
<div class="col-md-12">
	<hr>
</div>
<div class="col-md-12">
	<h4 class="subtitle">{{ trans('strings.contacts') }}</h4>
</div>
<div class="col-md-12">
	{!! Form::open() !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('email', null, ['id' => 'create-email', 'class' => 'form-control', 'placeholder' => trans('strings.email')]) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::text('phone', null, ['id' => 'create-phone', 'class' => 'form-control', 'placeholder' => trans('strings.phone')]) !!}
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('mobile', null, ['id' => 'create-mobile', 'class' => 'form-control', 'placeholder' => trans('strings.mobile')]) !!}
	    		</div>
	    		<div class="form-group col-md-6">
					{!! Form::text('other', null, ['id' => 'create-other', 'class' => 'form-control', 'placeholder' => trans('strings.other')]) !!}
	    		</div>
	    	</div>
	    </fieldset>
    {!! Form::close() !!}
</div>
<div class="col-md-12">
	<hr>
</div>