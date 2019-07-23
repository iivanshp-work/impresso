@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/users_notifications') }}">Users Notification</a> :
@endsection
@section("contentheader_description", $users_notification->$view_col)
@section("section", "Users Notifications")
@section("section_url", url(config('laraadmin.adminRoute') . '/users_notifications'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Users Notifications Edit : ".$users_notification->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($users_notification, ['route' => [config('laraadmin.adminRoute') . '.users_notifications.update', $users_notification->id ], 'method'=>'PUT', 'id' => 'users_notification-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'user_id')
					@la_input($module, 'type')
					@la_input($module, 'notification_text')
					@la_input($module, 'reference_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/users_notifications') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#users_notification-edit-form").validate({
		
	});
});
</script>
@endpush
