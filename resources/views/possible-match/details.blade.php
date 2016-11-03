@extends('layouts.principal')

@section('content')
		<div class="row">
			<div class="col-md-12 text-center">
		    	<h2 class="title">Registro Maestro</h2>
		    	<p>Completa los match</p>
		    	<h4 class="subtitle">Cliente existente</h4>
		    </div>
		    <div class="col-md-12">
		    	{!! Form::model($master) !!}
			    	<fieldset disabled>
				    	<div class="row">
				    		<div class="form-group col-md-6">
				    			<input type="hidden" name="id_master" id="id_master" value="{!! $master->id !!}"></input>
				    			{!! Form::text('social_reason', null, ['id' => 'search-full-name', 'class' => 'form-control', 'placeholder' => 'Nombre o Razón Social']) !!}
				    		</div>
				    		<div class="form-group col-md-6">
				    			{!! Form::text('rfc', null, ['id' => 'search-rfc', 'class' => 'form-control', 'placeholder' => 'RFC']) !!}
				    		</div>
				    	</div>
				    	<div class="row">
				    		<div class="form-group col-md-4">
				    			{!! Form::select('country', $countries, null, ['id' => 'search-country', 'class' => 'form-control', 'placeholder' => 'País']) !!}
				    		</div>
				    		<div class="form-group col-md-4">
				    			{!! Form::select('city', $cities, null, ['id' => 'search-city', 'class' => 'form-control', 'placeholder' => 'Ciudad']) !!}
				    		</div>
				    		<div class="form-group col-md-4">
				    			{!! Form::text('state', null, ['id' => 'search-state', 'class' => 'form-control', 'placeholder' => 'Estado']) !!}
				    		</div>
				    	</div>
				    	<div class="row">
				    		<div class="form-group col-md-4">
				    			{!! Form::text('street', null, ['id' => 'search-street', 'class' => 'form-control', 'placeholder' => 'Calle']) !!}
				    		</div>
				    		<div class="form-group col-md-4">
				    			{!! Form::text('no_int', null, ['id' => 'search-no_int', 'class' => 'form-control', 'placeholder' => 'No. Interior']) !!}
				    		</div>
				    		<div class="form-group col-md-4">
				    			{!! Form::text('no_ext', null, ['id' => 'search-no_ext', 'class' => 'form-control', 'placeholder' => 'No. Exterior']) !!}
				    		</div>
				    	</div>
				    	<div class="row">
				    		<div class="form-group col-md-6">
				    			{!! Form::text('colony', null, ['id' => 'search-colony', 'class' => 'form-control', 'placeholder' => 'Colonia']) !!}
				    		</div>
				    		<div class="form-group col-md-6">
				    			{!! Form::text('postal_code', null, ['id' => 'search-postal_code', 'class' => 'form-control', 'placeholder' => 'Código Postal']) !!}
				    		</div>
				    	</div>
					</fieldset>
		    	{!! Form::close() !!}
		    </div>
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
							                <th class="text-center">Nombre</th>
							                <th class="text-center">RFC</th>
							                <th class="text-center">Dirección</th>
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
							                <th class="text-center">Nombre</th>
							                <th class="text-center">RFC</th>
							                <th class="text-center">Dirección</th>
							                <th class="text-center">Acciones</th>
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
		    	@if($complete > 0)
		    		{!!link_to_route('possible-match.edit', $title = "Complete", $parameters = $master->id, $attributes = ['class' => 'btn btn-primary'])!!}
		    	@else
		    		{!!link_to_route('possible-match.edit', $title = "Complete", $parameters = $master->id, $attributes = ['class' => 'btn btn-primary disabled'])!!}
		    	@endif
		    </div>
		</div>
@endsection
@section('table-result')
@endsection