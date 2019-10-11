@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/user_resumes') }}">User Resume</a> :
@endsection
@section("contentheader_description", $user_resume->$view_col)
@section("section", "User Resumes")
@section("section_url", url(config('laraadmin.adminRoute') . '/user_resumes'))
@section("sub_section", "Edit")

@section("htmlheader_title", "User Resumes Edit : ".$user_resume->$view_col)

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
				{!! Form::model($user_resume, ['route' => [config('laraadmin.adminRoute') . '.user_resumes.update', $user_resume->id ], 'method'=>'PUT', 'id' => 'user_resume-edit-form']) !!}
					{{--@la_form($module)--}}

					<div class="form-group">
						<label for="url">User :</label>
						<input readonly="" class="form-control" placeholder="URL" data-rule-maxlength="256" name="url" type="text" value="@if($user_resume->user){{$user_resume->user->name ? $user_resume->user->name : $user_resume->user->email}}@endif">
						<input type="hidden" name="user_id" value="{{$user_resume->user_id}}">
						@php
							$selected_user_id = app('request')->input('selected_user_id');
						@endphp
						<input type="hidden" name="selected_user_id" value="{{$selected_user_id}}">
					</div>
					@la_input($module, 'title')
					<div class="form-group">
						<label for="status">Status* :</label>
						<select class="form-control" required="1" data-placeholder="Status" rel="select2" name="status">
							@foreach($statuses as $key => $value)
								<option value="{{$key}}" @if($key == $user_resume->status) selected="selected" @endif>{{$value}}</option>
							@endforeach
						</select>
					</div>
					@la_input($module, 'url')
					@la_input($module, 'files_uploaded')
					<br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/user_certifications') }}">Cancel</a></button>
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
	$("#user_resume-edit-form").validate({
		
	});
});
</script>
@endpush
