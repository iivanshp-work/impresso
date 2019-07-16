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
                    <div class="row" style="border-bottom: 1px dashed #e2e4e8;">
                        <div class="col-md-6">
                            <h4>General Info:</h4>
                            @la_input($module, 'name')
                            @la_input($module, 'email')
                            @la_input($module, 'password')
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
                        {!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/users') }}">Cancel</a></button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-12">
                    <table id="example1" class="table table-bordered">
                        <thead>
                        <tr class="success">
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Sign Up</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                13
                            </td>
                            <td>
                                <a href="http://impresso.me/public/admin/users/13">Ivan Tester</a>
                            </td>
                            <td>
                                iivanshp+test1@gmail.com
                            </td>
                            <td>
                                Verified

                            </td>
                            <td>
                                2019/07/04 20:54
                            </td>
                            <td><a href="http://impresso.me/public/admin/users/13/edit" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a><form method="POST" action="http://impresso.me/public/admin/users/13" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="hePdeOG5ghM3jWc4rEKpw16TwfI9cTYX2RAf3jft"> <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button></form></td>
                        </tr>
                        <tr>
                            <td>
                                12
                            </td>
                            <td>
                                <a href="http://impresso.me/public/admin/users/12">Name </a>
                            </td>
                            <td>
                                iivanshp+test@gmail.com
                            </td>
                            <td>
                                Verified

                            </td>
                            <td>
                                2019/07/04 20:52
                            </td>
                            <td><a href="http://impresso.me/public/admin/users/12/edit" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a><form method="POST" action="http://impresso.me/public/admin/users/12" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="hePdeOG5ghM3jWc4rEKpw16TwfI9cTYX2RAf3jft"> <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button></form></td>
                        </tr>
                        <tr>
                            <td>
                                11
                            </td>
                            <td>
                                <a href="http://impresso.me/public/admin/users/11"></a>
                            </td>
                            <td>
                                iivanshp@gmail.com
                            </td>
                            <td>
                                Not Verified

                            </td>
                            <td>
                                2019/07/04 20:52
                            </td>
                            <td><a href="http://impresso.me/public/admin/users/11/edit" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a><form method="POST" action="http://impresso.me/public/admin/users/11" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="hePdeOG5ghM3jWc4rEKpw16TwfI9cTYX2RAf3jft"> <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button></form></td>
                        </tr>
                        <tr>
                            <td>
                                10
                            </td>
                            <td>
                                <a href="http://impresso.me/public/admin/users/10">Ivan Developer</a>
                            </td>
                            <td>
                                admintest10@mail.com
                            </td>
                            <td>
                                Verified

                            </td>
                            <td>
                                2019/07/03 20:45
                            </td>
                            <td><a href="http://impresso.me/public/admin/users/10/edit" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a><form method="POST" action="http://impresso.me/public/admin/users/10" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="hePdeOG5ghM3jWc4rEKpw16TwfI9cTYX2RAf3jft"> <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button></form></td>
                        </tr>
                        <tr>
                            <td>
                                9
                            </td>
                            <td>
                                <a href="http://impresso.me/public/admin/users/9">Ivan</a>
                            </td>
                            <td>
                                admintest7@mail.com
                            </td>
                            <td>
                                Pending Varification

                            </td>
                            <td>
                                2019/07/03 20:35
                            </td>
                            <td><a href="http://impresso.me/public/admin/users/9/edit" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a><form method="POST" action="http://impresso.me/public/admin/users/9" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="hePdeOG5ghM3jWc4rEKpw16TwfI9cTYX2RAf3jft"> <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button></form></td>
                        </tr>
                        <tr>
                            <td>
                                2
                            </td>
                            <td>
                                <a href="http://impresso.me/public/admin/users/2">Test User</a>
                            </td>
                            <td>
                                test_user@mail.com
                            </td>
                            <td>
                                Not Verified

                            </td>
                            <td>
                                2019/07/02 21:14
                            </td>
                            <td><a href="http://impresso.me/public/admin/users/2/edit" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a><form method="POST" action="http://impresso.me/public/admin/users/2" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="hePdeOG5ghM3jWc4rEKpw16TwfI9cTYX2RAf3jft"> <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button></form></td>
                        </tr>
                        </tbody>
                    </table>
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
