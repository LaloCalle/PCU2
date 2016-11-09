<div class="row">
	<div class="form-group col-md-12">
		{!!Form::label(trans('strings.name').':')!!}
		{!!Form::text('name',null,['class'=>'form-control','placeholder'=>trans('strings.name')])!!}
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
		{!!Form::label(trans('strings.email').':')!!}
		{!!Form::text('email',null,['class'=>'form-control','placeholder'=>trans('strings.email')])!!}
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
		{!!Form::label(trans('strings.user').':')!!}
		{!!Form::text('username',null,['class'=>'form-control','placeholder'=>trans('strings.user')])!!}
	</div>
</div>