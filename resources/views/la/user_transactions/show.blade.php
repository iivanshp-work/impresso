@extends('la.layouts.app')

@section('htmlheader_title')
	User Transaction View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/user_transactions') }}" data-toggle="tooltip" data-placement="right" title="Back to User Transactions"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>General Info</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'user_id')
						@la_display($module, 'amount')
						@la_display($module, 'notes')
						@la_display($module, 'type')
						@if($user_transaction->by_user)
							<div class="form-group">
								<label for="by_user_id" class="col-md-2">By User :</label>
								<div class="col-md-10 fvalue"><a href="{{ url(config('laraadmin.adminRoute') . '/users/' . $user_transaction->by_user->id . '' ) }}">{{$user_transaction->by_user->name}}</a></div>
							</div>
						@endif
						@if($user_transaction->purchase)
							<div class="form-group">
								<label for="by_user_id" class="col-md-2">Purchase :</label>
								<div class="col-md-10 fvalue"><a href="{{ url(config('laraadmin.adminRoute') . '/user_purchases/' . $user_transaction->purchase->id . '' ) }}">{{$user_transaction->purchase->id}} - ${{$user_transaction->purchase->purchase_amount}}</a></div>
							</div>
						@endif
						@if($user_transaction->education)
							<div class="form-group">
								<label for="by_user_id" class="col-md-2">Education :</label>
								<div class="col-md-10 fvalue"><a href="{{ url(config('laraadmin.adminRoute') . '/user_educations/' . $user_transaction->education->id . '' ) }}">{{$user_transaction->education->title}}</a></div>
							</div>
						@endif
						@if($user_transaction->certification)
							<div class="form-group">
								<label for="by_user_id" class="col-md-2">Certification :</label>
								<div class="col-md-10 fvalue"><a href="{{ url(config('laraadmin.adminRoute') . '/user_certifications/' . $user_transaction->certification->id . '' ) }}">{{$user_transaction->certification->title}}</a></div>
							</div>
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>
@endsection
