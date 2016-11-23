@extends('layouts.principal')

@section('content')
	<div class="row">
		@include('forms.create')
	    <div class="col-md-12 text-right btn-footer">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	    	<button class="btn btn-secondary" id="master-create">{{ trans('strings.add') }}</button>
	    </div>
	</div>
	<div id="response"></div>
@endsection
@section('scripts')
	{!!Html::script('js/master-record-create.js')!!}
@endsection