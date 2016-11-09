@extends('layouts.principal')

@section('content')
		<div class="row">
			@include('forms.details')
		    <div class="col-md-12 text-right btn-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				{!!link_to('possible-match/'. $master->id .'/link', $title = trans('strings.addbranch'), $attributes = ['class' => 'btn btn-primary'])!!}
				{!!link_to_route('master-record.edit', $title = trans('strings.edit'), $parameters = $branch->id, $attributes = ['class' => 'btn btn-secondary'])!!}
				@if(Auth::user()->p_document == 1)
		    		<button class="btn btn-primary" id="seleccionar">{{ trans('strings.documentbutton') }}</button>
		    	@endif
		    </div>
@endsection
