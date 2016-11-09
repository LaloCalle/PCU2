<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('strings.delete') }} {{ trans('strings.user') }}</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id">
        <div class="form-group">
          {!!Form::label('name',trans('strings.name'))!!}
          <br>
          <span id="name"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button value="" id="eliminar" OnClick='EliminarUsuario(this);' class='btn btn-danger'>{{ trans('strings.delete') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('strings.close') }}</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->