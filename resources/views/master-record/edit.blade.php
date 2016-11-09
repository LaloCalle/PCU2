@extends('layouts.principal')

@section('content')
	<div class="row">
		@include('forms.edit')
	    <div class="col-md-12 text-right btn-footer">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
			<input type="hidden" name="url" value="master-record" id="url">
	    	<button class="btn btn-secondary" id="edit-update">{{ trans('strings.update') }}</button>
	    </div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/master-record-edit.js')!!}
@endsection