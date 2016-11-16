<div class="modal fade" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('strings.addbranch') }}: {!! $master->social_reason !!}</h4>
      </div>
      <div class="modal-body">
		@include('alerts.modal')
	    <h4 class="subtitle">{{ trans('strings.branch') }}</h4>
        {!! Form::open() !!}
	    	<fieldset>
		    	<div class="row">
		    		<div class="form-group col-md-12">
		    			<input type="hidden" name="id_branch" id="id_branch" value="{!! $branch->id !!}"></input>
		    			{!! Form::text('branch_description', null, ['id' => 'link-branch_description', 'class' => 'form-control', 'placeholder' => trans('strings.description')]) !!}
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-6">
		    			{!! Form::select('country', $countries, null, ['id' => 'link-country', 'class' => 'form-control', 'placeholder' => trans('strings.country')]) !!}
		    		</div>
		    		<div class="form-group col-md-6">
		    			{!! Form::select('city', $cities, null, ['id' => 'link-city', 'class' => 'form-control', 'placeholder' => trans('strings.city')]) !!}
		    		</div>
		    	</div>
		    	<div class="row" id="postal_codes_other">
		    		<div class="form-group col-md-4">
		    			{!! Form::text('postal_code', null, ['id' => 'link-postal_code', 'class' => 'form-control', 'placeholder' => trans('strings.postalcode')]) !!}
		    		</div>
		    		<div class="form-group col-md-4">
		    			{!! Form::text('colony', null, ['id' => 'link-colony', 'class' => 'form-control', 'placeholder' => trans('strings.colony')]) !!}
		    		</div>
		    		<div class="form-group col-md-4">
		    			{!! Form::text('state', null, ['id' => 'link-state', 'class' => 'form-control', 'placeholder' => trans('strings.state')]) !!}
		    		</div>
		    	</div>
		    	<div class="row" id="postal_codes_mx" style="display: none;">
					<div class="form-group col-md-4">
						{!! Form::text('postal_code', null, ['id' => 'link-postal_code_mx', 'class' => 'form-control', 'placeholder' => trans('strings.postalcode')]) !!}
					</div>
					<div class="form-group col-md-4">
						{!! Form::select('colony', [], null, ['id' => 'link-colony_mx', 'class' => 'form-control', 'placeholder' => trans('strings.colony')]) !!}
					</div>
					<div class="form-group col-md-4">
						{!! Form::text('state', null, ['id' => 'link-state_mx', 'class' => 'form-control', 'placeholder' => trans('strings.state'), 'disabled']) !!}
					</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-6">
		    			{!! Form::text('street', null, ['id' => 'link-street', 'class' => 'form-control', 'placeholder' => trans('strings.street')]) !!}
		    		</div>
		    		<div class="form-group col-md-3">
		    			{!! Form::text('no_ext', null, ['id' => 'link-no_ext', 'class' => 'form-control', 'placeholder' => trans('strings.noext')]) !!}
		    		</div>
		    		<div class="form-group col-md-3">
		    			{!! Form::text('no_int', null, ['id' => 'link-no_int', 'class' => 'form-control', 'placeholder' => trans('strings.noint')]) !!}
		    		</div>
		    	</div>
		    </fieldset>
	    {!! Form::close() !!}
    	<hr>
    	<h4 class="subtitle">{{ trans('strings.contacts') }}</h4>
        {!! Form::open() !!}
		    <fieldset>
		    	<div class="row">
		    		<div class="form-group col-md-6">
		    			{!! Form::text('email', null, ['id' => 'link-email', 'class' => 'form-control', 'placeholder' => trans('strings.email')]) !!}
		    		</div>
		    		<div class="form-group col-md-6">
		    			{!! Form::text('phone', null, ['id' => 'link-phone', 'class' => 'form-control', 'placeholder' => trans('strings.phone')]) !!}
		    		</div>
		    		<div class="form-group col-md-6">
		    			{!! Form::text('mobile', null, ['id' => 'link-mobile', 'class' => 'form-control', 'placeholder' => trans('strings.mobile')]) !!}
		    		</div>
		    		<div class="form-group col-md-6">
						{!! Form::text('other', null, ['id' => 'link-other', 'class' => 'form-control', 'placeholder' => trans('strings.other')]) !!}
		    		</div>
		    	</div>
		    </fieldset>
	    {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('strings.close') }}</button>
        <button type="button" class="btn btn-primary" id="link-add-branch">{{ trans('strings.add') }}</button>
      </div>
    </div>
  </div>
</div>