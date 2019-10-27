@extends("frontend.layouts.app")

@section("htmlheader_title")
    Sign In
@endsection

@section("main-content")
    <main class="main">
        <div class="login text-center">
            <h1 class="title login__title">Log In</h1>
            <a href="#" class="logo"><img src="{{ asset('/img/Logo.png') }}" alt="" /></a>
            <form id="signin_form" class="form" method="post" action="{{url('/sign-in')}}">
                <div class="form__body">
                    {{ csrf_field() }}
                    <div class="form__group">
                        <input name="email" type="email" placeholder="Email">
                    </div>
                    <div class="form__group">
                        <input name="password" type="password" placeholder="Password">
                    </div>
                    <div class="form__group">
                        <button type="submit" class="btn btn-violet">Log In</button>
                    </div>
                    <a href="{{url('/forgot-password')}}">Forgot your password?</a>
                </div>

                <div class="form__btn">
                    @if (in_array(app('request')->ip(), ["127.0.0.1", "146.120.169.6", "31.148.253.42", "213.55.220.15", "103.117.20.11", "10.11.0.236", "93.175.195.69"]))
                        <a href="{{url('/sign-in/linkedin')}}" class="btn btn-border btn-small">LinkedIn</a>
                        <a href="{{url('/sign-in/facebook')}}" class="btn btn-border btn-small">Facebook</a>
                    @endif
                    <a href="{{url('/sign-up')}}" class="btn btn-border">Sign Up FREE</a>
                </div>
            </form>
            @if(isset($failed_social_login) && $failed_social_login)
                <div id="failedSocialLogin" class="hide">{{ucfirst($provider)}} login: An error occurred, please try again or select another login option.</div>
            @endif
        </div>
    </main>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
