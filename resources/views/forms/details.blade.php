<div class="col-md-12">
	<h2 class="title">{{ trans('strings.masterrecord') }}</h2>
	<h4 class="subtitle">{{ trans('strings.existingcustomer') }}</h4>
</div>
<div class="col-md-12">
	<h4 class="subtitle">{{ trans('strings.company') }}</h4>
</div>
<div class="col-md-12">
	<div class="table-responsive">
		<table class="table table-hover table-bordered table-striped">
			<tbody>
				<tr>
					<td><b>{{ trans('strings.namesocialreason') }}</b></td>
					<td>{!! $master->social_reason !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.rfc') }}</b></td>
					<td>{!! $master->rfc !!}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-12">
	<h4 class="subtitle">{{ trans('strings.branch') }}</h4>
</div>
<div class="col-md-12">
	<div class="table-responsive">
		<table class="table table-hover table-bordered table-striped">
			<tbody>
				<tr>
					<td><b>{{ trans('strings.idunique') }}</b></td>
					<td>{!! $branch->id_unique_customer !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.description') }}</b></td>
					<td>{!! $branch->branch_description !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.street') }}</b></td>
					<td>{!! $branch->street !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.noext') }}</b></td>
					<td>{!! $branch->no_ext !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.noint') }}</b></td>
					<td>{!! $branch->no_int !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.colony') }}</b></td>
					<td>{!! $branch->colony !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.state') }}</b></td>
					<td>{!! $branch->state !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.city') }}</b></td>
					<td>{!! $branch->city !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.country') }}</b></td>
					<td>{!! $branch->country !!}</td>
				</tr>
				<tr>
					<td><b>{{ trans('strings.postalcode') }}</b></td>
					<td>{!! $branch->postal_code !!}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-12">
	<h4 class="subtitle">{{ trans('strings.contacts') }}</h4>
</div>
<div class="col-md-12">
	<div class="table-responsive">
		<table class="table table-hover table-bordered table-striped">
			<thead>
				<tr>
					<th>{{ trans('strings.type') }}</th>
					<th>{{ trans('strings.description') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($contacts as $contact)
    				<tr>
    					<td><b>{!! $contact->type !!}</b></td>
    					<td>{!! $contact->description !!}</td>
    				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-12">
	<hr>
</div>