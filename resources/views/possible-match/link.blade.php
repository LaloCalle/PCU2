@extends('layouts.principal')

@section('content')
	<div class="row">
		<div class="col-md-12">
	    	<h2 class="title">{{ trans('strings.masterrecord') }}</h2>
	    </div>
	    <div class="col-md-12">
	    	<h4 class="subtitle">{{ trans('strings.existingcustomer') }}</h4>
	    </div>
			<div class="col-md-12">
		    	<h4 class="subtitle">{{ trans('strings.company') }}</h4>
		    </div>
		    <div class="col-md-12">
			    <input type="hidden" name="id_master" id="id_master" value="{!! $master->id !!}"></input>
		    	<div class="table-responsive">
		    		<table class="table table-hover table-bordered table-striped">
		    			<tbody>
		    				<tr>
		    					<td><b>{{ trans('strings.namesocialreason') }}</b></td>
		    					<td><input type="hidden" name="social_reason" id="social_reason" value="{!! $master->social_reason !!}"></input>{!! $master->social_reason !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>{{ trans('strings.rfc') }}</b></td>
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
	    	<h4 class="subtitle">{{ trans('strings.branches') }}</h4>
	    </div>
	    <div class="col-md-12">
	    	<div class="table-responsive">
	    		<table class="table table-hover table-bordered table-striped">
	    			<thead>
	    				<tr>
	    					<th>{{ trans('strings.idunique') }}</th>
	    					<th>{{ trans('strings.branch') }}</th>
	    					<th>{{ trans('strings.actions') }}</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach($branches as $branch)
		    				<tr>
		    					<td>{!! $branch->id_unique_customer !!}</td>
		    					<td>{!! $branch->branch_description !!}</td>
		    					<td class="text-center" style="min-width: 250px;">
		    						{!!link_to_route('possible-match.edit', $title = trans('strings.edit'), $parameters = $branch->id, $attributes = ['class' => 'btn btn-primary'])!!}
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
			<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addBranch">{{ trans('strings.addbranch') }}</button>
	    </div>
	</div>

	@include('possible-match.modals.modal-add-branch')
@endsection
@section('scripts')
	{!!Html::script('js/possible-match-link.js')!!}
@endsection