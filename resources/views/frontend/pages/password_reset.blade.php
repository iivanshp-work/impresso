@extends("frontend.layouts.app")

@section("htmlheader_title")
    Change password
@endsection

@section("main-content")
    <main class="main">
        <div class="password text-center">
            <h1 class="title password__title">Change Password</h1>
            <a href="#" class="logo"><img src="{{ asset('/img/Logo.png') }}" alt="" /></a>
            <form data-reset-password-form="" class="form" method="post" action="{{url('/password/reset')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="token" value="{{ $token }}">
                @if($email)
                    <input type="hidden" name="email" value="{{$email}}">
                @endif
                <div class="form__body">
                    @if(!$email)
                        <div class="form__group">
                            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}"/>
                        </div>
                    @endif
                    <div class="form__group">
                        <input type="password" name="password" placeholder="New Password">
                    </div>
                    <div class="form__group">
                        <input type="password" name="password_confirmation" placeholder="Re-enter Password">
                    </div>
                </div>
                <div class="form__btn">
                    <button type="submit" class="btn btn-violet">Change Password</button>
                    <a href="{{url('/sign-in')}}" class="btn btn-border">Cancel</a>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('popups')
    <button class="btn btn-violet open-pop-up" data-target="#passwordChanged" id="passwordResetSuccess">Password Changed</button>
    <button class="btn btn-violet open-pop-up" data-target="#passwordChangedCancelled" id="passwordResetFail">Password Changed Cancelled</button>

    <div class="modal-window" id="passwordChanged">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <h5 class="modal-window__subtitle">Password changed</h5>
                <p>Your password has been changed.<br />
                    Please open the App to Log In</p>
            </div>
        </div>
    </div>
    <div class="modal-window" id="passwordChangedCancelled">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <h5 class="modal-window__subtitle">Password changed<br /> cancelled</h5>
                <p>Your password has not been changed.</p>
            </div>
        </div>
    </div>
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush
