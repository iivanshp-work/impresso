@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/user_educations') }}">User Education</a> :
@endsection
@section("contentheader_description", $user_education->$view_col)
@section("section", "User Educations")
@section("section_url", url(config('laraadmin.adminRoute') . '/user_educations'))
@section("sub_section", "Edit")

@section("htmlheader_title", "User Educations Edit : ".$user_education->$view_col)

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
				{!! Form::model($user_education, ['route' => [config('laraadmin.adminRoute') . '.user_educations.update', $user_education->id ], 'method'=>'PUT', 'id' => 'user_education-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title')
					@la_input($module, 'speciality')
					@la_input($module, 'status')
					@la_input($module, 'user_id')
					@la_input($module, 'url')
					@la_input($module, 'files_uploaded')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/user_educations') }}">Cancel</a></button>
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
	$("#user_education-edit-form").validate({
		
	});
});
</script>
@endpush
