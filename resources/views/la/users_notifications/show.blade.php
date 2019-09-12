@extends('la.layouts.app')

@section('htmlheader_title')
	Users Notification View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		@php
			$selected_user_id = app('request')->input('selected_user_id');
		@endphp
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/users_notifications' . ($selected_user_id ? '?selected_user_id=' . $selected_user_id : '')) }}" data-toggle="tooltip" data-placement="right" title="Back to Users Notifications"><i class="fa fa-chevron-left"></i></a></li>
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
						@la_display($module, 'notification_text')
					</div>
				</div>
			</div>
		</div>
		
	</div>
	</div>
	</div>
</div>
@endsection
