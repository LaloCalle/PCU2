@extends('layouts.principal')

@section('content')
		<div class="row">
			@include('forms.details')
		    <div class="col-md-12">
		    	<div>
				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#match" aria-controls="match" role="tab" data-toggle="tab">Match</a></li>
				    <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Review</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="match">
						<div class="col-md-12">
					    	<div class="table-responsive">
						        <table class="table table-striped table-hover" id="table-match">
							        <thead>
							            <tr>
							                <th class="text-center">{{ trans('strings.socialreason') }}</th>
							                <th class="text-center">{{ trans('strings.rfc') }}</th>
							                <th class="text-center">{{ trans('strings.address') }}</th>
							            </tr>
							        </thead>
							        <tbody>
							        	@foreach($matches as $match)
								        	<tr>
								        		<td class="text-center name-match">
								        			<input type="hidden" name="id_match[]" value="{!! $match->id !!}"></input>
								        			<span>{!! $match->social_reason !!}</span>
								        		</td>
								        		<td class="text-center rfc-match">{!! $match->rfc !!}</td>
								        		<td class="text-center street-match">
								        			{!! $match->street !!},
								        			@if($match->no_int != "")
								        				{!! $match->no_int !!},
								        			@endif

								        			@if($match->no_ext != "")
								        				{!! $match->no_ext !!},
								        			@endif

								        			@if($match->colony != "")
								        				{!! $match->colony !!},
								        			@endif

								        			@if($match->state != "")
								        				{!! $match->state !!},
								        			@endif

								        			@if($match->city != "")
								        				{!! $match->city !!},
								        			@endif

								        			@if($match->country != "")
								        				{!! $match->country !!},
								        			@endif

								        			@if($match->postal_code != "")
								        				{!! $match->postal_code !!}
								        			@endif
								        		</td>
								        	</tr>
										@endforeach
							        </tbody>
							    </table>
							</div>
						</div>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="review">
						<div class="col-md-12">
					    	<div class="table-responsive">
						        <table class="table table-striped table-hover">
							        <thead>
							            <tr>
							                <th class="text-center">{{ trans('strings.socialreason') }}</th>
							                <th class="text-center">{{ trans('strings.rfc') }}</th>
							                <th class="text-center">{{ trans('strings.address') }}</th>
							                <th class="text-center">{{ trans('strings.actions') }}</th>
							            </tr>
							        </thead>
							        <tbody>
							        	@foreach($reviews as $review)
								        	<tr>
								        		<td class="text-center">{!! $review->social_reason !!}</td>
								        		<td class="text-center">{!! $review->rfc !!}</td>
								        		<td class="text-center">
								        			{!! $review->street !!},
								        			@if($review->no_int != "")
								        				{!! $review->no_int !!},
								        			@endif

								        			@if($review->no_ext != "")
								        				{!! $review->no_ext !!},
								        			@endif

								        			@if($review->colony != "")
								        				{!! $review->colony !!},
								        			@endif

								        			@if($review->state != "")
								        				{!! $review->state !!},
								        			@endif

								        			@if($review->city != "")
								        				{!! $review->city !!},
								        			@endif

								        			@if($review->country != "")
								        				{!! $review->country !!},
								        			@endif

								        			@if($review->postal_code != "")
								        				{!! $review->postal_code !!}
								        			@endif
								        		</td>
								        		<td class="text-center">
								        			{!! Form::checkbox('review[]', $review->id, false, ['data-switch-no-init']) !!}
								        		</td>
								        	</tr>
										@endforeach
							        </tbody>
							    </table>
							</div>
						</div>
				    </div>
				  </div>
				</div>
		    </div>
		    <div class="col-md-12">
		    	<hr>
		    </div>
		    <div class="col-md-12 text-right btn-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
		    	<button class="btn btn-secondary" id="match-button">Match</button>
		    	{!!link_to_route('possible-match.edit', $title = trans('strings.completebutton'), $parameters = $branch->id, $attributes = ['class' => 'btn btn-primary'])!!}
		    </div>
		</div>
@endsection
@section('table-result')
@endsection
@section('scripts')
	{!!Html::script('js/custom-match.js')!!}
@endsection