@extends('layouts.principal')

@section('content')
	@include('users.modal')
	<div class="row">
		<div class="col-md-12">
	    	<h2 class="title">{{ trans('strings.users') }}</h2>
	    </div>
	</div>
	<div class="row">
		<div class="col-md-3">
    		<h4 class="subtitle">{{ trans('strings.userslist') }}</h4>
    		<p class="float-left">{{ trans('strings.viewlineview') }} {!! $users->firstItem() !!} {{ trans('strings.viewlineto') }} {!! $users->lastItem() !!} {{ trans('strings.viewlineof') }} {!! $users->total() !!} {{ trans('strings.viewlineusers') }}</p>
    	</div>
		<div class="col-md-9 text-right">
	    	{!! $users->appends(Request::all())->render() !!}
	    </div>
		<div class="col-md-12">
	    	<div class="table-responsive">
		        <table class="table table-striped table-hover">
			        <thead>
			            <tr>
			                <th class="text-center">{{ trans('strings.name') }}</th>
			                <th class="text-center">{{ trans('strings.email') }}</th>
							<th class="col-btn text-center">{{ trans('strings.view') }}</th>
							<th class="col-btn text-center">{{ trans('strings.edit') }}</th>
							<th class="col-btn text-center">{{ trans('strings.delete') }}</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($users as $user)
				        	<tr>
				        		<td class="text-center">{!! $user->name !!}</td>
				        		<td class="text-center">{!! $user->email !!}</td>
								<td class="col-btn text-center">
									{!!link_to_route('users.show', $title = trans('strings.view'), $parameters = $user->id, $attributes = ['class' => 'btn btn-info'])!!}
								</td>
								<td class="col-btn text-center">
									{!!link_to_route('users.edit', $title = trans('strings.edit'), $parameters = $user->id, $attributes = ['class' => 'btn btn-primary'])!!}
								</td>
								<td class="col-btn text-center">
									<button OnClick='Mostrar({!!$user->id!!}, "{!!$user->name!!}");' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal'>{{ trans('strings.delete') }}</button>
								</td>
				        	</tr>
						@endforeach
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	{!!Html::script('js/delete-reg.js')!!}
@endsection