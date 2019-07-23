@extends('la.layouts.app')

@section('htmlheader_title')
	Notification View
@endsection


@section('main-content')
<div id="page-content" class="profile2">


	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/notifications') }}" data-toggle="tooltip" data-placement="right" title="Back to Notifications"><i class="fa fa-chevron-left"></i></a></li>
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
						@la_display($module, 'title')
						@la_display($module, 'notification_text')
						<div class="form-group">
							<label for="status" class="col-md-2">Status :</label>
							<div class="col-md-10 fvalue">
								<div class="label label-success">@if($notification->status){{'Active'}}@else{{'Inactive'}}@endif</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>
@endsection
