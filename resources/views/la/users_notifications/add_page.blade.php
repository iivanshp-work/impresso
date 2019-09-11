@extends("la.layouts.app")

@section("contentheader_title")
    <a href="{{ url(config('laraadmin.adminRoute') . '/users_notifications?selected_user_id=' . $selectedUser->id) }}">{{"Adding User Notifications : "}}</a>
@endsection
@section("contentheader_description", ($selectedUser ? $selectedUser->name : ''))
@section("section", "User Notifications")
@section("section_url", url(config('laraadmin.adminRoute') . '/users_notifications?selected_user_id=' . $selectedUser->id))
@section("sub_section", "Add")

@section("htmlheader_title", "Adding User Notifications : ". ($selectedUser ? $selectedUser->name : ''))

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
                    @php
                        $url = app('request')->url();
                        if($selectedUser) {
                            $url .= '?selected_user_id=' . $selectedUser->id;
                        }
                    @endphp
                    <form method="POST" action="{{$url}}" accept-charset="UTF-8" id="user_not-edit-form" novalidate="novalidate">
                        <input name="_token" type="hidden" value="{{csrf_token()}}">
                        @if ($selectedUser)
                            <div class="form-group">
                                <label for="status">User :</label>
                                <input type="text" class="form-control" value="{{$selectedUser->id}} - {{$selectedUser->name ? $selectedUser->name : $selectedUser->email}}" readonly="">
                            </div>
                        @endif
                        @if($purchase_id)
                            <input type="hidden" name="type" value="admin_manual">
                        @endif

                        <div class="form-group">
                            <label for="notes">Notification Text :</label>
                            <textarea class="form-control valid" required aria-required="" placeholder="Notification Text" cols="30" rows="3" name="notification_text" aria-invalid="false"></textarea>
                        </div>

                        <br>
                        <div class="form-group">
                            {!! Form::submit( 'Save', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '//users_notifications?selected_user_id=' . $selectedUser->id) }}">Cancel</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {
            $("#user_not-edit-form").validate({

            });
        });
    </script>
@endpush
