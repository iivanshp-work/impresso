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
                    <div class="form-group">
                        {!! Form::submit( 'Update', ['class'=>'btn btn-success margin-r-5']) !!}
                        <button type="button" class="btn btn-github margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/users_notifications?selected_user_id=' . $user->id) }}"><i class="fa fa fa-bell-o margin-r-5"></i> Notifications</a></button>
                        <button type="button" class="btn btn-success margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/user_transactions?selected_user_id=' . $user->id) }}"><i class="fa fa fa-money margin-r-5"></i> Transactions</a></button>
                        <button type="button" class="btn btn-pinterest margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/user_purchases?selected_user_id=' . $user->id) }}"><i class="fa fa fa-cc-stripe margin-r-5"></i> Purchases</a></button>
                        <button type="button" class="btn btn-primary margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/user_certifications?selected_user_id=' . $user->id) }}"><i class="fa fa fa-certificate margin-r-5"></i> Certifications</a></button>
                        <button type="button" class="btn btn-bitbucket margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/user_educations?selected_user_id=' . $user->id) }}"><i class="fa fa fa-archive margin-r-5"></i> Educations</a></button>
                        <button type="button" class="btn btn-default margin-r-5 "><a href="{{ url(config('laraadmin.adminRoute') . '/users') }}">Cancel</a></button>
                    </div>
                    <div class="row" style="border-bottom: 1px dashed #e2e4e8;">
                        <div class="col-md-6">
                            <h4>General Info:</h4>
                            <div class="form-group">
                                <label for="name">Name* :</label>
                                <input class="form-control" placeholder="Name" data-rule-maxlength="255" name="name" type="text" value="{{$user->name}}">
                            </div>
                            @la_input($module, 'email')
                            @la_input($module, 'password')
                            <div class="form-group">
                                <label for="status">Credits Count :</label>
                                <input type="text" class="form-control" value="{{$user->credits_count}}" readonly="">
                            </div>
                            <div class="form-group">
                                <label for="status">Share Count :</label>
                                <input type="text" class="form-control" value="{{$user->share_count}}" readonly="">
                            </div>
                            <input type="hidden" name="type" value="{{$mode == "admins" ? getenv('USERS_TYPE_ADMIN') : getenv('USERS_TYPE_USER')}}">
                        </div>
                        <div class="col-md-6" style="border-left: 1px dashed #e2e4e8;">
                            <h4>Validation Info:</h4>
                            {{--@la_input($module, 'is_verified')
                            @la_input($module, 'varification_pending')--}}


                            <div class="form-group">
                                <label for="status">Status* :</label>
                                <select class="form-control valid" required="1" name="status">
                                    <option value="1" @if($user->is_verified) selected @endif>Verified</option>
                                    <option value="2" @if($user->varification_pending && !$user->is_verified) selected @endif>Pending Varification</option>
                                    <option value="3" @if(!$user->varification_pending && !$user->is_verified) selected @endif>Not Verified</option>
                                </select>
                            </div>


                            @la_input($module, 'photo_id')
                            @la_input($module, 'photo_selfie')
                        </div>
                    </div>
                    <div class="row" style="border-bottom: 1px dashed #e2e4e8;">
                        <div class="col-md-6" style="border-right: 1px dashed #e2e4e8;">
                            <h4>Profile Public Info:</h4>
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
                            <h4>Profile Private Info:</h4>
                            @la_input($module, 'phone')
                            @la_input($module, 'full_name_birth')
                            @la_input($module, 'birth_date')
                            @la_input($module, 'address')
                            @la_input($module, 'address2')
                            @la_input($module, 'city')

                            <h4>Location Info:</h4>
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
                        {!! Form::submit( 'Update', ['class'=>'btn btn-success margin-r-5']) !!}
                        <button type="button" class="btn btn-github margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/users_notifications?selected_user_id=' . $user->id) }}"><i class="fa fa fa-bell-o margin-r-5"></i> Notifications</a></button>
                        <button type="button" class="btn btn-success margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/user_transactions?selected_user_id=' . $user->id) }}"><i class="fa fa fa-money margin-r-5"></i> Transactions</a></button>
                        <button type="button" class="btn btn-pinterest margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/user_purchases?selected_user_id=' . $user->id) }}"><i class="fa fa fa-cc-stripe margin-r-5"></i> Purchases</a></button>
                        <button type="button" class="btn btn-primary margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/user_certifications?selected_user_id=' . $user->id) }}"><i class="fa fa fa-certificate margin-r-5"></i> Certifications</a></button>
                        <button type="button" class="btn btn-bitbucket margin-r-5 pull-right"><a style="color: #fff" href="{{ url(config('laraadmin.adminRoute') . '/user_educations?selected_user_id=' . $user->id) }}"><i class="fa fa fa-archive margin-r-5"></i> Educations</a></button>
                        <button type="button" class="btn btn-default margin-r-5 "><a href="{{ url(config('laraadmin.adminRoute') . '/users') }}">Cancel</a></button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script src="{{ asset('/js/components/jquery.mask.js') }}"></script>
<script>
$(function () {
	$("#user-edit-form").validate({

	});
    if ($('[name="birth_date"]').length) {
        $('[name="birth_date"]').mask("00:00:0000", {placeholder: "DD:MM:YYYY", clearIfNotMatch: true});
    }
});
</script>
@endpush
