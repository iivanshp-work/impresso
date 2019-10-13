@extends("frontend.layouts.app")

@section("htmlheader_title")
    Change password
@endsection

@section("main-content")
    <main class="main">
        <div class="password text-center">
            <h1 class="title password__title">Change Password</h1>
            <a href="#" class="logo"><img src="{{ asset('/img/Logo.png') }}" alt="" /></a>
            <form data-forgot-password-form="" class="form" method="post" action="{{url('/password/email')}}">
                <div class="form__body">
                    <div class="form__group">
                        <input name="email" type="email" placeholder="Email">
                    </div>
                    <p>Enter the same E-mail address you used for Signing Up.</p>
                </div>
                <div class="form__btn">
                    <button type="submit" class="btn btn-violet">Enter</button>
                    <a href="{{url('/sign-in')}}" class="btn btn-border">Back</a>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('popups')
    <button class="btn btn-violet open-pop-up hide" data-target="#resetPassword" id="forgotPasswordPopup">Reset Password</button>
    <div class="modal-window" id="resetPassword">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <h5 class="modal-window__subtitle">Reset Password</h5>
                <p>You have requested for a password reset
                    Please check your e-mail.</p>
                <a href="{{url('/sign-in')}}" class="btn btn-border">
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
