@extends('layouts.principal')

@section('content')
    <div class="row">
		<div class="col-md-12">
			<h3 class="title">{{ trans('strings.userprofile') }}</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-striped">
					<tbody>
						<tr>
							<th>{{ trans('strings.name') }}</th>
							<td>{{ $user->name }}</td>
						</tr>
						<tr>
							<th>{{ trans('strings.email') }}</th>
							<td>{{ $user->email }}</td>
						</tr>
						<tr>
							<th>{{ trans('strings.permissions') }}</th>
							<td>
								<ul>
									@if($user->p_superadmin == 1)
										<li>{{ trans('strings.superadmin') }}</li>
									@endif
									@if($user->p_admin == 1)
										<li>{{ trans('strings.admin') }}</li>
									@endif
									@if($user->p_document == 1)
										<li>{{ trans('strings.documenter') }}</li>
									@endif
								</ul>
							</td>
						</tr>
						<tr>
							<th>{{ trans('strings.user') }}</th>
							<td>{{ $user->username }}</td>
						</tr>
						<tr>
							<th>{{ trans('strings.created') }}</th>
							<td>{{ $user->created_at }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-right">
			{!!link_to_route('users.edit', $title = trans('strings.edit'), $parameters = $user->id, $attributes = ['class' => 'btn btn-primary'])!!}
		</div>
	</div>
@endsection