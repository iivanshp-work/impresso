@extends('la.layouts.app')

@section('htmlheader_title')
	User View
@endsection


@section('main-content')
<div id="page-content" class="profile2">

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/' . ($mode == "admins" ? 'administrators' : 'users')) }}" data-toggle="tooltip" data-placement="right" title="Back to {{($mode == "admins" ? 'Administrators' : 'Users')}}"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					@if($mode == "admins")
						<div class="panel-default panel-heading">
							<h4>General Info</h4>
						</div>
						<div class="panel-body">
							@la_display($module, 'name')
							@la_display($module, 'email')
						</div>
					@else
						<div class="panel-default panel-heading">
							<h4>General Info</h4>
						</div>
						<div class="panel-body">
							@la_display($module, 'name')
							@la_display($module, 'email')
							@la_display($module, 'password')
							<div class="form-group">
								<label for="is_verified" class="col-md-2">Credits Count :</label>
								<div class="col-md-10 fvalue">{{$user->credits_count}}</div>
							</div>
							<div class="form-group">
								<label for="is_verified" class="col-md-2">Share Count :</label>
								<div class="col-md-10 fvalue">{{$user->share_count}}</div>
							</div>
						</div>
						<div class="panel-default panel-heading">
							<h4>Validation Info</h4>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="is_verified" class="col-md-2">Status :</label>
								<div class="col-md-10 fvalue">
									@if ($user->is_verified)
										<div class='label label-success'>Verified</div>
									@elseif($user->varification_pending && !$user->is_verified)
										<div class='label label-warning'>Pending Varification</div>
									@else
										<div class='label label-danger'>Not Verified</div>
									@endif
								</div>
							</div>
							@la_display($module, 'photo_id')
							@la_display($module, 'photo_selfie')
						</div>
						<div class="panel-default panel-heading">
							<h4>Profile Public Info</h4>
						</div>
						<div class="panel-body">
							@la_display($module, 'photo')
							@la_display($module, 'job_title')
							@la_display($module, 'company_title')
							@la_display($module, 'university_title')
							@la_display($module, 'certificate_title')
							@la_display($module, 'impress')
							<div class="form-group">
								<label for="top_skills" class="col-md-2">Top Skills :</label>
								<div class="col-md-10 fvalue">
									{!! str_replace("\n", "<br>", $user->top_skills) !!}
								</div>
							</div>
							<div class="form-group">
								<label for="soft_skills" class="col-md-2">Soft Skills :</label>
								<div class="col-md-10 fvalue">
									{!! str_replace("\n", "<br>", $user->soft_skills) !!}
								</div>
							</div>
						</div>
						<div class="panel-default panel-heading">
							<h4>Profile Private Info</h4>
						</div>
						<div class="panel-body">
							@la_display($module, 'phone')
							@la_display($module, 'full_name_birth')
							@la_display($module, 'address')
							@la_display($module, 'address2')
							@la_display($module, 'city')
						</div>
						<div class="panel-default panel-heading">
							<h4>Location Info</h4>
						</div>
						<div class="panel-body">
							@la_display($module, 'location_title')
							@la_display($module, 'longitude')
							@la_display($module, 'latitude')
						</div>
					@endif
				</div>
			</div>
		</div>
		
	</div>
	</div>
	</div>
</div>
@endsection
