@extends('layouts.principal')

@section('content')
	<div class="row">
		<div class="col-md-3">
	    	<h2 class="title">{{ trans('strings.match') }}</h2>
	    </div>
		<div class="col-md-9">
			{!! Form::model(Request::all()) !!}
				<div class="form-group col-md-4 col-md-offset-8">
					{!! Form::select('orederbystatus', ['match' => 'Match', 'review' => 'Review', 'nomatch' => 'No Match'], null, ['id' => 'orderbystatus', 'class'=>'form-control','placeholder'=>trans('strings.orderby')]) !!}
				</div>
			{!! Form::close()!!}
		</div>
	</div>
@endsection
@section('table-result')
	<div class="row">
		<div class="col-md-3">
    		<h4 class="subtitle">{{ trans('strings.statusmatch') }}</h4>
    		<p class="float-left">{{ trans('strings.viewlineview') }} {!! $masters->firstItem() !!} {{ trans('strings.viewlineto') }} {!! $masters->lastItem() !!} {{ trans('strings.viewlineof') }} {!! $masters->total() !!} {{ trans('strings.viewlinecustomers') }}</p>
    	</div>
		<div class="col-md-9 text-right">
	    	{!! $masters->appends(Request::all())->render() !!}
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
			                <th class="text-center">{{ trans('strings.status') }}</th>
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
				        		@if($master->status_match == 'match')
				        			<td class="text-center green">MATCH</td>
				        		@elseif($master->status_match == 'review')
				        			<td class="text-center yellow">REVIEW</td>
				        		@else
				        			<td class="text-center red">NO MATCH</td>
				        		@endif
				        		<td class="text-center" style="min-width: 250px;">
				        			{!!link_to_route('possible-match.show', $title = trans('strings.detailsbutton'), $parameters = $master->id, $attributes = ['class' => 'btn btn-primary'])!!}
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
	{!!Html::script('js/order-by-status.js')!!}
@endsection