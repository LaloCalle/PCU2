@extends('layouts.principal')

@section('content')
	@include('master-record.progressbar')
	<div class="row">
		@include('forms.create')
	    <div class="col-md-12 text-right btn-footer">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	    	<button id='master-create' class='btn btn-secondary' data-toggle='modal' data-target='#progressbarModal'>{{ trans('strings.add') }}</button>
	    </div>
	</div>
	<div id="response"></div>
@endsection
@section('scripts')
	{!!Html::script('js/master-record-create.js')!!}
@endsection