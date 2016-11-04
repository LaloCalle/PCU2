@extends('layouts.principal')

@section('content')
	<div class="row">
		@include('forms.edit')
	    <div class="col-md-12 text-right btn-footer">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			<input type="hidden" name="url" value="possible-match" id="url">
	    	<button class="btn btn-secondary" id="edit-update">Actualizar</button>
	    	<a href="{!! env('APP_ROUTE_VM') !!}/possible-match/{!! $master->id !!}/link" class="btn btn-primary">Link</a>
	    </div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/master-record-edit.js')!!}
@endsection