@extends("frontend.layouts.app")

@section("htmlheader_title")
    Sign Up
@endsection

@section("main-content")
    <main class="main">
        <div class="sign-up text-center">
            <h1 class="title sign-up__title">Welcome to IMPRESSO</h1>
            <a href="#"><img src="{{ asset('/img/Logo.png') }}" alt="" class="logo" /></a>
            <form id="signup_form" class="form" method="post" action="{{url('/sign-up')}}">
                {{ csrf_field() }}
                <div class="form__group">
                    <input name="email" type="email" placeholder="Email" />
                </div>
                <div class="form__group">
                    <input name="password" type="password" placeholder="Password" />
                </div>
                <p>Already have an account? <a href="{{url('/sign-in')}}">Log In</a></p>
                <div class="form__btn">
                    <small>By signing up you agree with our <a href="https://www.impressolabs.io/privacy">T&Cs</a>.</small>
                    <button type="submit" class="btn btn-violet">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
