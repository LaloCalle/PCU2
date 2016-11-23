<!-- Modal -->
<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('strings.documentbutton') }}</h4>
      </div>
      <div class="modal-body">
        @include('alerts.modal')
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id">
        <div class="form-group">
          {!!Form::label('id_customer',trans('strings.idunique').': ')!!} <span id="id_customer"></span>
        </div>
        <div class="form-group">
          {!!Form::label('social_reason',trans('strings.socialreason').': ')!!} <span id="social_reason"></span>
        </div>
        <div class="form-group">
          {!!Form::label('rfc',trans('strings.rfc').': ')!!} <span id="rfc"></span>
        </div>
        <div class="form-group">
          {!!Form::label('branch',trans('strings.branch').': ')!!} <span id="branch"></span>
        </div>
        <div class="form-group">
          <label for="preguide">{{ trans('strings.preguide') }}</label>
          {!! Form::text('preguide', null, ['id' => 'preguide', 'class' => 'form-control', 'placeholder' => trans('strings.preguide')]) !!}
          <p class="help-block">{{ trans('strings.preguidenote') }}</p>
        </div>
      </div>
      <div class="modal-footer">
        <button value="" id="id_unique_customer" OnClick='Documentar();' class='btn btn-primary'>{{ trans('strings.documentbutton') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('strings.close') }}</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->