@extends('layouts.principal')

@section('content')
	@include('match.progressbar')
	<div class="row">
		<div class="col-md-12">
	    	<h2 class="title">¡Bienvenido!</h2>
	    	<h4 class="subtitle">Fuente de datos:</h4>
	    	<div class="table-responsive">
		        <table class="table table-striped table-hover">
			        <thead>
			            <tr>
			                <th class="text-center">Fuente</th>
			                <th class="text-center">Estátus</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<tr>
			        		<td class="text-center">EDX</td>
			        		<td class="text-center">
			        			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							</td>
			        	</tr>
			        	<tr>
			        		<td class="text-center">Participant</td>
			        		<td class="text-center">
			        			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							</td>
			        	</tr>
			        	<tr>
			        		<td class="text-center">CList</td>
			        		<td class="text-center">
			        			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							</td>
			        	</tr>
			        </tbody>
			    </table>
			</div>
		    <div class="col-md-12 text-right">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				<button id='extract-button' class='btn btn-primary' data-toggle='modal' data-target='#progressbarModal'>Aceptar</button>
		    </div>
		</div>
	</div>
@endsection

@section('scripts')
	{!!Html::script('js/extract-match.js')!!}
@endsection