@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/' . ($mode == 'admins' ? 'administrators' : 'users')) }}">{{($mode == 'admins' ? 'Administrator' : 'User')}}</a> :
@endsection
@section("contentheader_description", $user->$view_col)
@section("section", ($mode == 'admins' ? 'Administrators' : 'Users'))
@section("section_url", url(config('laraadmin.adminRoute') . '/' . ($mode == 'admins' ? 'administrators' : 'users')))
@section("sub_section", "Edit")

@section("htmlheader_title", ($mode == 'admins' ? 'Administrators' : 'Users') . " Edit : ".$user->$view_col)

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
    @if ($mode == 'admins')
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    {!! Form::model($user, ['route' => [config('laraadmin.adminRoute') . '.users.update', $user->id ], 'method'=>'PUT', 'id' => 'user-edit-form']) !!}
                    @la_input($module, 'name')
                    @la_input($module, 'email')
                    @la_input($module, 'password')
                    <input type="hidden" name="type" value="{{$mode == "admins" ? getenv('USERS_TYPE_ADMIN') : getenv('USERS_TYPE_USER')}}">
                    <br>
                    <div class="form-group">
                        {!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/administrators') }}">Cancel</a></button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @else
        <div class="box-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    {!! Form::model($user, ['route' => [config('laraadmin.adminRoute') . '.users.update', $user->id ], 'method'=>'PUT', 'id' => 'user-edit-form']) !!}
                    {{--@la_form($module)--}}
                    <div class="row" style="border-bottom: 1px solid #808080;">
                        <div class="col-md-6">
                            <h3>General Info:</h3>
                            @la_input($module, 'name')
                            @la_input($module, 'email')
                            @la_input($module, 'password')
                            <input type="hidden" name="type" value="{{$mode == "admins" ? getenv('USERS_TYPE_ADMIN') : getenv('USERS_TYPE_USER')}}">
                        </div>
                        <div class="col-md-6" style="border-left: 1px solid #808080;">
                            <h3>Validation Info:</h3>
                            @la_input($module, 'is_verified')
                            @la_input($module, 'varification_pending')
                            @la_input($module, 'photo_id')
                            @la_input($module, 'photo_selfie')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px solid #808080;">
                            <h3>Profile Public Info:</h3>
                            @la_input($module, 'photo')
                            @la_input($module, 'job_title')
                            @la_input($module, 'company_title')
                            @la_input($module, 'university_title')
                            @la_input($module, 'certificate_title')
                            @la_input($module, 'impress')
                            @la_input($module, 'top_skills')
                            @la_input($module, 'soft_skills')
                        </div>
                        <div class="col-md-6">
                            <h3>Profile Private Info:</h3>
                            @la_input($module, 'phone')
                            @la_input($module, 'full_name_birth')
                            @la_input($module, 'address')
                            @la_input($module, 'address2')
                            @la_input($module, 'city')

                            <h3>Location Info:</h3>
                            @la_input($module, 'location_title')
                            @la_input($module, 'longitude')
                            @la_input($module, 'latitude')
                        </div>
                    </div>
                    {{--
                    @la_input($module, 'name') +
                    @la_input($module, 'email') +
                    @la_input($module, 'password') +
                    @la_input($module, 'type') +
                    @la_input($module, 'is_verified') +
                    @la_input($module, 'job_title') +
                    @la_input($module, 'company_title') +
                    @la_input($module, 'photo') +
                    @la_input($module, 'photo_id') +
                    @la_input($module, 'photo_selfie') +
                    @la_input($module, 'location_title') +
                    @la_input($module, 'top_skills') +
                    @la_input($module, 'soft_skills') +
                    @la_input($module, 'impress') +
                    @la_input($module, 'phone') +
                    @la_input($module, 'provider')
                    @la_input($module, 'provider_id')
                    @la_input($module, 'varification_pending') +
                    @la_input($module, 'longitude') +
                    @la_input($module, 'latitude') +
                    @la_input($module, 'university_title') +
                    @la_input($module, 'certificate_title') +
                    --}}
                    <br>
                    <div class="form-group">
                        {!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/users') }}">Cancel</a></button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#user-edit-form").validate({

	});
});
</script>
@endpush
