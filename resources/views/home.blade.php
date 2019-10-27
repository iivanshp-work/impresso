@extends("frontend.layouts.app")

@section("htmlheader_title")
    Homepage
@endsection

@section("main-content")
    <main class="main">
        <div class="slider">
            <div class="slider__item slider__item_first">
                <div class="slider__content">
                    <h2 class="slider__title title">Meetup for Professionals</h2>
                    <p>Go on valuable professional dates.</p>
                    <span class="slider__author">Photo by averie woodard on Unsplash</span>
                </div>
            </div>
            <div class="slider__item slider__item_second">
                <div class="slider__content">
                    <h2 class="slider__title title">No Fake Data <br />Here</h2>
                    <p>Meetup with validated people only.</p>
                    <span class="slider__author">Photo by Drew Graham on Unsplash</span>
                </div>
            </div>
            <div class="slider__item slider__item_third">
                <div class="slider__content">
                    <h2 class="slider__title title">Just Be <br /> Yourself</h2>
                    <p>Meetup for Career Advice<br />
                        or Business Networking.</p>
                    <span class="slider__author">Photo by George Bohunicky on Unsplash</span>
                </div>
            </div>
            <div class="slider__item slider__item_fourth">
                <div class="slider__content">
                    <h2 class="slider__title title">It’s Who You<br /> Know</h2>
                    <p>80% of businesses and jobs<br />
                        are closed via referrals.</p>
                    <span class="slider__author">Photo by Patricia Palma on Unsplash</span>
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
