@extends("frontend.layouts.app")

@section("htmlheader_title")
    Sign In
@endsection

@section("main-content")
    <main class="main">
        <div class="login text-center">
            <span class="login__title-top">Log In</span>
            <h1 class="title login__title">Welcome <br />back</h1>
            <a href="#"><img src="{{ asset('/img/Logo.png') }}" alt="" class="logo" /></a>
            <form id="signin_form" class="form" method="post" action="{{url('/sign-in')}}">
                {{ csrf_field() }}
                <div class="form__group">
                    <input name="email" type="email" placeholder="Email">
                </div>
                <div class="form__group">
                    <input name="password" type="password" placeholder="Password">
                </div>
                <p>New to IMPRESSO? <a href="{{url('/sign-up')}}">Sign Up</a></p>
                <div class="form__btn">
                    <small>Thank you for choosing us.</small>
                    <button type="submit" class="btn btn-violet">Log In</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
