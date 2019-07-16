@extends('la.layouts.app')

@section('htmlheader_title')
	User certification View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
    @php
        $selected_user_id = app('request')->input('selected_user_id');
    @endphp
	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/user_certifications' . ($selected_user_id ? '?selected_user_id=' . $selected_user_id : '')) }}" data-toggle="tooltip" data-placement="right" title="Back to User certifications"><i class="fa fa-chevron-left"></i></a></li>
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
                        <div class="form-group">
                            <label for="user_id" class="col-md-2">User :</label>
                            <div class="col-md-10 fvalue">
                                <a href="http://impresso.me/public/admin/users/{{$user_certification->user_id}}" class="label label-primary">@if($user_certification->user){{$user_certification->user->name ? $user_certification->user->name : $user_certification->user->email}}@endif</a>
                            </div>
                        </div>
						@la_display($module, 'title')
						@la_display($module, 'status')
                        @la_display($module, 'url')
						@la_display($module, 'files_uploaded')
					</div>
				</div>
			</div>
		</div>

	</div>
	</div>
	</div>
</div>
@endsection
