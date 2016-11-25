<!-- Modal -->
<div class="modal fade" id="progressbarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        -->
        <h4 class="modal-title">{{ trans('strings.matchverify') }}</h4>
      </div>
      <div class="modal-body">
  	    <p class="text-center">{{ trans('strings.matchverifynote') }}</p>
  	    <div id="progressbar"><div class="progress-label"></div></div>
  	    <div class="text-center" id="total-registros"></div>
  	    <div class="text-center" id="total-match"></div>
      </div>
      <div class="modal-footer">

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->