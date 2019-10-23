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
                    <a href="{{url('/forgot-password')}}">Forgot your password?</a>
                </div>

                <div class="form__btn">
                    @if (app('request')->ip() == "31.148.253.44")
                        <a href="{{url('/sign-in/facebook')}}" class="btn btn-border btn-small">Facebook</a>
                        <a href="{{url('/sign-in/google')}}" class="btn btn-border btn-small">Google</a>
                        <a href="{{url('/sign-in/linkedin')}}" class="btn btn-border btn-small">LinkedIn</a>
                        <a href="{{url('/sign-in/twitter')}}" class="btn btn-border btn-small">Twitter</a>
                    @endif
                    <button type="submit" class="btn btn-violet">Log In</button>
                    <a href="{{url('/sign-up')}}" class="btn btn-border">Back</a>
                </div>
            </form>
            @if($failed_social_login)
                <div id="failedSocialLogin" class="hide">{{ucfirst($provider)}} login: An error occurred, please try again or select another login option.</div>
            @endif
        </div>
    </main>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
