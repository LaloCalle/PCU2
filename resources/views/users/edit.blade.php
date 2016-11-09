@extends('layouts.principal')

@section('content')
	<div class="row">
		<div class="col-md-12">
	    	<h2 class="title">{{ trans('strings.edit') }} {{ trans('strings.user') }}</h2>
	    </div>
	</div>

	<div class="row">
		<div class="col-md-12">
			{!!Form::model($user,['route'=>['users.update',$user->id],'method'=>'PUT'])!!}
				<fieldset>
					@include('users.forms.usr')
					<div class="row">
						<div class="form-group col-md-12">
							<p class="help-block">{{ trans('strings.editpasswordnote') }}</p>
						</div>
					</div>
					@include('users.forms.usrpass')
					@include('users.forms.usrpermissions')
				</fieldset>
				<div class="form-group text-right">
					{!!Form::submit(trans('strings.update'),['class'=>'btn btn-primary'])!!}
				</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/add-user.js')!!}
@endsection