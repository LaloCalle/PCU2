<div class="row">
	<div class="form-group col-md-12">
		{!!Form::label(trans('strings.permissions').':')!!}
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
		<input name="p_all" id="p_all" type="checkbox" data-size="mini" value="1">
		{!!Form::label(trans('strings.all'))!!}
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
		@if(isset($user))
			<input name="p_superadmin" id="p_superadmin" type="checkbox" data-size="mini" value="1" {{$user->p_superadmin}}>
		@else
			<input name="p_superadmin" id="p_superadmin" type="checkbox" data-size="mini" value="1">
		@endif
		{!!Form::label(trans('strings.superadmin'))!!}
	</div>
	<div class="form-group col-md-12">
		@if(isset($user))
			<input name="p_admin" id="p_admin" type="checkbox" data-size="mini" value="1" {{$user->p_admin}}>
		@else
			<input name="p_admin" id="p_admin" type="checkbox" data-size="mini" value="1">
		@endif
		{!!Form::label(trans('strings.admin'))!!}
	</div>
	<div class="form-group col-md-12">
		@if(isset($user))
			<input name="p_document" id="p_document" type="checkbox" data-size="mini" value="1" {{$user->p_document}}>
		@else
			<input name="p_document" id="p_document" type="checkbox" data-size="mini" value="1">
		@endif
		{!!Form::label(trans('strings.documenter'))!!}
	</div>
</div>