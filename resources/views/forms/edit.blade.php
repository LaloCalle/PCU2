<div class="col-md-8">
	<h2 class="title">{{ trans('strings.masterrecord') }}</h2>
</div>
<div class="col-md-4 progressbar-complete">
	<div id="progressbar-complete"><div class="progress-label">{!! $porcentaje !!}%</div></div>
</div>
<div class="col-md-12">
	<p>{{ trans('strings.editnote') }}</p>
	<h4 class="subtitle">{{ trans('strings.existingcustomer') }}</h4>
</div>
<div class="col-md-12">
	<h4 class="subtitle">{{ trans('strings.company') }}</h4>
</div>
<div class="col-md-12">
	{!! Form::model($master) !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			<input type="hidden" name="id_master" id="id_master" value="{!! $master->id !!}"></input>
	    			{!! Form::text('social_reason', null, ['id' => 'edit-social_reason', 'class' => 'form-control', 'placeholder' => trans('strings.namesocialreason')]) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::text('rfc', null, ['id' => 'edit-rfc', 'class' => 'form-control', 'placeholder' => trans('strings.rfc')]) !!}
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
	{!! Form::model($branch) !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			<input type="hidden" name="id_branch" id="id_branch" value="{!! $branch->id !!}"></input>
	    			{!! Form::text('id_unique_customer', null, ['id' => 'edit-id_unique_customer', 'class' => 'form-control', 'placeholder' => trans('strings.idunique'), 'disabled']) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::text('branch_description', null, ['id' => 'edit-branch_description', 'class' => 'form-control', 'placeholder' => trans('strings.description')]) !!}
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::select('country', $countries, null, ['id' => 'edit-country', 'class' => 'form-control', 'placeholder' => trans('strings.country')]) !!}
	    		</div>
	    		<div class="form-group col-md-6">
	    			{!! Form::select('city', $cities, null, ['id' => 'edit-city', 'class' => 'form-control', 'placeholder' => trans('strings.city')]) !!}
	    		</div>
		    </div>
	    	<div class="row" id="postal_codes_other">
	    		<div class="form-group col-md-4">
	    			{!! Form::text('postal_code', null, ['id' => 'edit-postal_code', 'class' => 'form-control', 'placeholder' => trans('strings.postalcode')]) !!}
	    		</div>
	    		<div class="form-group col-md-4">
	    			{!! Form::text('colony', null, ['id' => 'edit-colony', 'class' => 'form-control', 'placeholder' => trans('strings.colony')]) !!}
	    		</div>
	    		<div class="form-group col-md-4">
	    			{!! Form::text('state', null, ['id' => 'edit-state', 'class' => 'form-control', 'placeholder' => trans('strings.state')]) !!}
	    		</div>
	    	</div>
	    	<div class="row" id="postal_codes_mx" style="display: none;">
				<div class="form-group col-md-4">
					{!! Form::text('postal_code', null, ['id' => 'edit-postal_code_mx', 'class' => 'form-control', 'placeholder' => trans('strings.postalcode')]) !!}
				</div>
				<div class="form-group col-md-4">
					{!! Form::select('colony', [], null, ['id' => 'edit-colony_mx', 'class' => 'form-control', 'placeholder' => trans('strings.colony')]) !!}
				</div>
				<div class="form-group col-md-4">
					{!! Form::text('state', null, ['id' => 'edit-state_mx', 'class' => 'form-control', 'placeholder' => trans('strings.state'), 'disabled']) !!}
				</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			{!! Form::text('street', null, ['id' => 'edit-street', 'class' => 'form-control', 'placeholder' => trans('strings.street')]) !!}
	    		</div>
	    		<div class="form-group col-md-3">
	    			{!! Form::text('no_ext', null, ['id' => 'edit-no_ext', 'class' => 'form-control', 'placeholder' => trans('strings.noext')]) !!}
	    		</div>
	    		<div class="form-group col-md-3">
	    			{!! Form::text('no_int', null, ['id' => 'edit-no_int', 'class' => 'form-control', 'placeholder' => trans('strings.noint')]) !!}
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
	{!! Form::model($contacts) !!}
    	<fieldset>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			@if($contacts->count() == 0)
						{!! Form::text('email', null, ['id' => 'edit-email', 'class' => 'form-control', 'placeholder' => trans('strings.email')]) !!}
					@else
						<?php $controlador = 0; ?>
						@foreach($contacts as $contact)
							@if($contact->type == "email")
								{!! Form::text('email', $contact->description, ['id' => 'edit-email', 'class' => 'form-control', 'placeholder' => trans('strings.email')]) !!}
								<?php $controlador = 1; ?>
							@endif
						@endforeach
						@if($controlador == 0)
							{!! Form::text('email', null, ['id' => 'edit-email', 'class' => 'form-control', 'placeholder' => trans('strings.email')]) !!}
						@endif
					@endif
	    		</div>
	    		<div class="form-group col-md-6">
	    			@if($contacts->count() == 0)
						{!! Form::text('phone', null, ['id' => 'edit-phone', 'class' => 'form-control', 'placeholder' => trans('strings.phone')]) !!}
					@else
						<?php $controlador = 0; ?>
						@foreach($contacts as $contact)
							@if($contact->type == "phone")
								{!! Form::text('phone', $contact->description, ['id' => 'edit-phone', 'class' => 'form-control', 'placeholder' => trans('strings.phone')]) !!}
								<?php $controlador = 1; ?>
							@endif
						@endforeach
						@if($controlador == 0)
							{!! Form::text('phone', null, ['id' => 'edit-phone', 'class' => 'form-control', 'placeholder' => trans('strings.phone')]) !!}
						@endif
					@endif
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="form-group col-md-6">
	    			@if($contacts->count() == 0)
						{!! Form::text('mobile', null, ['id' => 'edit-mobile', 'class' => 'form-control', 'placeholder' => trans('strings.mobile')]) !!}
					@else
						<?php $controlador = 0; ?>
						@foreach($contacts as $contact)
							@if($contact->type == "mobile")
								{!! Form::text('mobile', $contact->description, ['id' => 'edit-mobile', 'class' => 'form-control', 'placeholder' => trans('strings.mobile')]) !!}
								<?php $controlador = 1; ?>
							@endif
						@endforeach
						@if($controlador == 0)
							{!! Form::text('mobile', null, ['id' => 'edit-mobile', 'class' => 'form-control', 'placeholder' => trans('strings.mobile')]) !!}
						@endif
					@endif
	    		</div>
	    		<div class="form-group col-md-6">
					@if($contacts->count() == 0)
						{!! Form::text('other', null, ['id' => 'edit-other', 'class' => 'form-control', 'placeholder' => trans('strings.other')]) !!}
					@else
						<?php $controlador = 0; ?>
						@foreach($contacts as $contact)
							@if($contact->type == "other")
								{!! Form::text('other', $contact->description, ['id' => 'edit-other', 'class' => 'form-control', 'placeholder' => trans('strings.other')]) !!}
								<?php $controlador = 1; ?>
							@endif
						@endforeach
						@if($controlador == 0)
							{!! Form::text('other', null, ['id' => 'edit-other', 'class' => 'form-control', 'placeholder' => trans('strings.other')]) !!}
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