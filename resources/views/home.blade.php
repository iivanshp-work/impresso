@extends("frontend.layouts.app")

@section("htmlheader_title")
    Homepage
@endsection

@section("main-content")
    <main class="main">
        <div class="slider">
            <div class="slider__item slider__item_first">
                <div class="slider__content">
                    <h2 class="slider__title title">Business Dating for Professionals.</h2>
                    <p>Go on a genuine business date & learn skills from real professionals.</p>
                </div>
            </div>
            <div class="slider__item slider__item_second">
                <div class="slider__content">
                    <h2 class="slider__title title">Authentic & Verified Profiles.</h2>
                    <p>Browse through verified profiles.</p>
                    <p>Find the right connection for you<br /> to grow your career.</p>
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
                        Career Growth<br />
                        Everyday
                    </h2>
                    <p>
                        80% of jobs are closed<br />
                        through networking
                    </p>
                </div>
                <a href="{{url('/sign-in')}}" class="btn btn-violet slider__btn">Continue</a>
            </div>
        </div>
    </main>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
