@if(Session::has('message-success'))
	<div class="alert alert-success alert-dismissible" role="alert">
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  	<strong>Felicidades!</strong> {{Session::get('message-success')}}
	</div>
@endif