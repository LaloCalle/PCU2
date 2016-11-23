@extends('layouts.principal')

@section('content')
	@include('modals.document')
		<div class="row">
			@include('forms.details')
		    <div class="col-md-12 text-right btn-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
				{!!link_to('possible-match/'. $master->id .'/link', $title = trans('strings.addbranch'), $attributes = ['class' => 'btn btn-primary'])!!}
				{!!link_to_route('master-record.edit', $title = trans('strings.edit'), $parameters = $branch->id, $attributes = ['class' => 'btn btn-secondary'])!!}
				@if(Auth::user()->p_document == 1)
					<button OnClick='DocumentarOpen("{!! $master->social_reason !!}","{!! $master->rfc !!}","{!! $master->branch_description !!}","{!! $master->id_unique_customer !!}");' class='btn btn-primary' data-toggle='modal' data-target='#documentModal'>{{ trans('strings.documentbutton') }}</button>
		    	@endif
		    </div>
@endsection
@section('scripts')
	{!!Html::script('js/document.js')!!}
@endsection
