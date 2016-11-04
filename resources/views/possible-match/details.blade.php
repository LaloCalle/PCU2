@extends('layouts.principal')

@section('content')
		<div class="row">
			<div class="col-md-12 text-center">
		    	<h2 class="title">Registro Maestro</h2>
		    	<p>Completa los match</p>
		    	<h4 class="subtitle">Cliente existente</h4>
		    </div>
			<div class="col-md-12">
		    	<h4 class="subtitle">Compañía</h4>
		    </div>
		    <div class="col-md-12">
		    	<div class="table-responsive">
		    		<table class="table table-hover table-bordered table-striped">
		    			<tbody>
		    				<tr>
		    					<td><b>Nombre o Razón Social</b></td>
		    					<td>{!! $master->social_reason !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>RFC</b></td>
		    					<td>{!! $master->rfc !!}</td>
		    				</tr>
		    			</tbody>
		    		</table>
		    	</div>
		    </div>
			<div class="col-md-12">
		    	<h4 class="subtitle">Sucursal</h4>
		    </div>
		    <div class="col-md-12">
		    	<div class="table-responsive">
		    		<table class="table table-hover table-bordered table-striped">
		    			<tbody>
		    				<tr>
		    					<td><b>ID</b></td>
		    					<td>{!! $branch->id_unique_customer !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Descripción</b></td>
		    					<td>{!! $branch->branch_description !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Calle</b></td>
		    					<td>{!! $branch->street !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>No. Exterior</b></td>
		    					<td>{!! $branch->no_ext !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>No. Interior</b></td>
		    					<td>{!! $branch->no_int !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Colonia</b></td>
		    					<td>{!! $branch->colony !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Estado</b></td>
		    					<td>{!! $branch->state !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Ciudad</b></td>
		    					<td>{!! $branch->city !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>País</b></td>
		    					<td>{!! $branch->country !!}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Código Postal</b></td>
		    					<td>{!! $branch->postal_code !!}</td>
		    				</tr>
		    			</tbody>
		    		</table>
		    	</div>
		    </div>
			<div class="col-md-12">
		    	<h4 class="subtitle">Contactos</h4>
		    </div>
		    <div class="col-md-12">
		    	<div class="table-responsive">
		    		<table class="table table-hover table-bordered table-striped">
		    			<thead>
		    				<tr>
		    					<th>Tipo</th>
		    					<th>Descripción</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    				@foreach($contacts as $contact)
			    				<tr>
			    					<td><b>{!! $contact->type !!}</b></td>
			    					<td>{!! $contact->description !!}</td>
			    				</tr>
		    				@endforeach
		    			</tbody>
		    		</table>
		    	</div>
		    </div>
		    <div class="col-md-12">
		    	<hr>
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
		    	{!!link_to_route('possible-match.edit', $title = "Complete", $parameters = $branch->id, $attributes = ['class' => 'btn btn-primary'])!!}
		    </div>
		</div>
@endsection
@section('table-result')
@endsection
@section('scripts')
	{!!Html::script('js/custom-match.js')!!}
@endsection