@extends("frontend.layouts.app")

@section("htmlheader_title")
    Change password
@endsection

@section("main-content")
    <main class="main">
        <div class="password text-center">
            <h1 class="title password__title">Change Password</h1>
            <a href="#" class="logo"><img src="{{ asset('/img/Logo.png') }}" alt="" /></a>
            <form data-change-password-form="" class="form" method="post" action="{{url('/settings/change-password')}}">
                <div class="form__body">
                    <div class="form__group">
                        <input name="old_password" type="password" placeholder="Old Password">
                    </div>
                    <div class="form__group">
                        <input name="password" type="password" placeholder="New Password">
                    </div>
                    <div class="form__group">
                        <input name="password_confirmation" type="password" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form__btn">
                    <button type="submit" class="btn btn-violet">Change Password</button>
                    <a href="{{url('/settings/edit')}}" class="btn btn-border">Back</a>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('popups')
    <button class="btn btn-violet open-pop-up hide" id="passwordChangedPopup" data-target="#resetPassword">Reset Password</button>
    <div class="modal-window" id="resetPassword">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <img src="{{asset('img/icons/like.png')}}" alt="" class="modal-window__img-top">
                <p>Your password has been changed.</p>
                <a href="{{url('/settings/edit')}}" class="btn btn-border">
                    Got it!
                </a>
            </div>
        </div>
    </div>
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush
