@extends("frontend.layouts.app")

@section("htmlheader_title")
    Referral
@endsection

@section("main-content")
    <main class="main">
        <div class="referral">
            <div class="referral__content">
                <h2 class="referral__title title">Meetup for<br /> Professionals</h2>
                <p>With this friend invite you will receive $3 worth of XIMs once your profile has been verified.
                </p>
                <span class="referral__author">Photo by averie woodard</span>
            </div>
            <a href="{{url('/sign-in')}}" class="btn btn-border referral__btn">Continue</a>
        </div>
    </main>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
