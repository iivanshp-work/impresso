@extends("frontend.layouts.app")

@section("htmlheader_title")
    Sign Up
@endsection

@section("main-content")
    <main class="main">
        <div class="sign-up text-center">
            <h1 class="title sign-up__title">Sign Up</h1>
            <a href="#" class="logo"><img src="{{ asset('/img/Logo.png') }}" alt="" class="logo" /></a>
            <form id="signup_form" class="form" method="post" action="{{url('/sign-up')}}">
                <div class="form__body">
                    {{ csrf_field() }}
                    <div class="form__group">
                        <input name="email" type="email" placeholder="Email" />
                    </div>
                    <div class="form__group">
                        <input name="password" type="password" placeholder="Password" />
                    </div>
                    <div class="form__group">
                        <input name="password_confirmation" type="password" placeholder="Confirm Password" />
                    </div>
                    <span>By signing up you agree with our <a href="https://www.impressolabs.io/privacy">T&Cs.</a></span>
                </div>
                <div class="form__btn">
                    <button type="submit" class="btn btn-violet">
                        Continue
                    </button>
                    <a href="{{url('/sign-in')}}" class="btn btn-border">
                        Log In
                    </a>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
