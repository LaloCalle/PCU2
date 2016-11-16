@extends('layouts.principal')

@section('content')
	<div class="row">
		<div class="col-md-12">
	    	<h2 class="title">{{ trans('strings.adduser') }}</h2>
	    </div>
	</div>

	<div class="row">
		<div class="col-md-12">
			{!!Form::open(['route'=>'users.store','method'=>'POST','autocomplete'=>'off'])!!}
				<fieldset>
					@include('users.forms.usr')
					@include('users.forms.usrpass')
					@include('users.forms.usrpermissions')
				</fieldset>
				<div class="form-group text-right">
					{!!Form::submit(trans('strings.add'),['class'=>'btn btn-primary'])!!}
				</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
@section('table-result')
@endsection
@section('scripts')
	{!!Html::script('js/add-user.js')!!}
@endsection