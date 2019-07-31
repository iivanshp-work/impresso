@extends("frontend.layouts.app")

@section("htmlheader_title")
    Homepage
@endsection

@section("main-content")
    <main class="main">
        <div class="slider">
            <div class="slider__item slider__item_first">
                <div class="slider__content">
                    <h2 class="slider__title title">Real Connections. Real Meetings.</h2>
                    <p>Go on a genuine business date & learn skills from real professionals.</p>
                </div>
            </div>
            <div class="slider__item slider__item_second">
                <div class="slider__content">
                    <h2 class="slider__title title">Authentic & Verified Profiles.</h2>
                    <p>Browse through verified profiles & CVs.</p>
                    <p>Find the perfect job for you.</p>
                </div>
            </div>
            <div class="slider__item slider__item_third">
                <div class="slider__content">
                    <h2 class="slider__title title">No Fake Profiles Allowed</h2>
                    <p>
                        IMPRESSO is made for you to<br />
                        meet real people.
                    </p>
                    <p>Earn tokens as you network.</p>
                </div>
            </div>
            <div class="slider__item slider__item_fourth">
                <div class="slider__content">
                    <h2 class="slider__title title">
                        Your Data.<br />
                        Your Career.
                    </h2>
                    <p>
                        Improve your chances of getting<br />
                        a job by 40x.
                    </p>
                </div>
                <a href="{{url('/sign-in')}}" class="btn btn-border slider__btn">Continue</a>
            </div>
        </div>
    </main>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
