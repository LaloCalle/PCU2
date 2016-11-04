@extends('layouts.principal')

@section('content')
		<div class="row">
			@include('forms.details')
		    <div class="col-md-12 text-right btn-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				{!!link_to_route('master-record.edit', $title = "Editar", $parameters = $branch->id, $attributes = ['class' => 'btn btn-secondary'])!!}
		    	<button class="btn btn-primary" id="seleccionar">Documentar</button>
		    </div>
@endsection