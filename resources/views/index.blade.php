@extends('layouts.principal')

@section('content')
	@include('modals.document')
	<div class="row">
		<div class="col-md-12 text-center">
	    	<h2 class="title">¡{{ trans('strings.welcome') }}!</h2>
	    	<h4 class="subtitle">{{ trans('strings.welcomesubtitle') }}</h4>
	    	<p>{{ trans('strings.welcomesubtitlenote') }}</p>
	    </div>
	</div>
	<div class="row">
	    <div class="col-md-12">
	    	<h4 class="subtitle">{{ trans('strings.customersearch') }}</h4>
	    	<p>{{ trans('strings.filtersnote') }}</p>
	    </div>
	    <div class="col-md-12">
	    	{!! Form::model(Request::all()) !!}
		    	<div class="row">
		    		<div class="form-group col-md-6">
		    			{!! Form::text('name', null, ['id' => 'search-name', 'class' => 'form-control', 'placeholder' => trans('strings.namelastnamesocialreason')]) !!}
		    		</div>
		    		<div class="form-group col-md-6">
		    			{!! Form::text('rfc', null, ['id' => 'search-rfc', 'class' => 'form-control', 'placeholder' => trans('strings.rfc')]) !!}
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-4">
		    			{!! Form::text('id_unique_customer', null, ['id' => 'search-id-unique-customer', 'class' => 'form-control', 'placeholder' => trans('strings.idunique')]) !!}
		    		</div>
		    		<div class="form-group col-md-4">
		    			{!! Form::text('branch_description', null, ['id' => 'search-branch-description', 'class' => 'form-control', 'placeholder' => trans('strings.branch')]) !!}
		    		</div>
		    		<div class="form-group col-md-4">
		    			{!! Form::text('contact', null, ['id' => 'search-contact', 'class' => 'form-control', 'placeholder' => trans('strings.phonemobileemail')]) !!}
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-3">
		    			{!! Form::text('country', null, ['id' => 'search-country', 'class' => 'form-control', 'placeholder' => trans('strings.country')]) !!}
		    		</div>
		    		<div class="form-group col-md-3">
		    			{!! Form::text('city', null, ['id' => 'search-city', 'class' => 'form-control', 'placeholder' => trans('strings.city')]) !!}
		    		</div>
		    		<div class="form-group col-md-3">
		    			{!! Form::text('state', null, ['id' => 'search-state', 'class' => 'form-control', 'placeholder' => trans('strings.state')]) !!}
		    		</div>
		    		<div class="form-group col-md-3">
		    			{!! Form::text('postal_code', null, ['id' => 'search-postal-code', 'class' => 'form-control', 'placeholder' => trans('strings.postalcode')]) !!}
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-md-4">
		    			{!! Form::text('colony', null, ['id' => 'search-colony', 'class' => 'form-control', 'placeholder' => trans('strings.colony')]) !!}
		    		</div>
		    		<div class="form-group col-md-4">
		    			{!! Form::text('street', null, ['id' => 'search-street', 'class' => 'form-control', 'placeholder' => trans('strings.street')]) !!}
		    		</div>
		    		<div class="form-group col-sm-6 col-md-2">
		    			{!! Form::text('no_ext', null, ['id' => 'search-no-ext', 'class' => 'form-control', 'placeholder' => trans('strings.noext')]) !!}
		    		</div>
		    		<div class="form-group col-sm-6 col-md-2">
		    			{!! Form::text('no_int', null, ['id' => 'search-no-int', 'class' => 'form-control', 'placeholder' => trans('strings.noint')]) !!}
		    		</div>
		    	</div>
	    	{!! Form::close() !!}
	    </div>
	</div>
@endsection
@section('table-result')
		<div class="row">
			<div class="col-md-3">
	    		<h4 class="subtitle">{{ trans('strings.matchesfound') }}</h4>
	    		<p class="float-left">{{ trans('strings.viewlineview') }} {!! $masters->firstItem() !!} {{ trans('strings.viewlineto') }} {!! $masters->lastItem() !!} {{ trans('strings.viewlineof') }} {!! $masters->total() !!} {{ trans('strings.viewlinecustomers') }}</p>
	    	</div>
			<div class="col-md-9 text-right">
		    	{!! $masters->render() !!}
		    </div>
			<div class="col-md-12">
		    	<div class="table-responsive">
			        <table class="table table-striped table-hover">
				        <thead>
				            <tr>
				                <th class="text-center">{{ trans('strings.idunique') }}</th>
				                <th class="text-center">{{ trans('strings.socialreason') }}</th>
				                <th class="text-center">{{ trans('strings.rfc') }}</th>
				                <th class="text-center">{{ trans('strings.branch') }}</th>
				                <th class="text-center">{{ trans('strings.actions') }}</th>
				            </tr>
				        </thead>
				        <tbody>
				        	@foreach($masters as $master)
					        	<tr>
					        		<td class="text-center">{!! $master->id_unique_customer !!}</td>
					        		<td class="text-center">{!! $master->social_reason !!}</td>
					        		<td class="text-center">{!! $master->rfc !!}</td>
					        		<td class="text-center">{!! $master->branch_description !!}</td>
					        		<td class="text-center" style="min-width: 250px;">
					        			{!!link_to_route('master-record.show', $title = trans('strings.view'), $parameters = $master->id, $attributes = ['class' => 'btn btn-primary'])!!}
					        			@if(Auth::user()->p_document == 1)
					        				<button OnClick='DocumentarOpen("{!! $master->social_reason !!}","{!! $master->rfc !!}","{!! $master->branch_description !!}","{!! $master->id_unique_customer !!}");' class='btn btn-primary' data-toggle='modal' data-target='#documentModal'>{{ trans('strings.documentbutton') }}</button>
					        			@endif
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
	{!!Html::script('js/document.js')!!}
@endsection