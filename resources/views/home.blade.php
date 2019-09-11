@extends("frontend.layouts.app")

@section("htmlheader_title")
    Homepage
@endsection

@section("main-content")
    <main class="main">
        <div class="slider">
            <div class="slider__item slider__item_first">
                <div class="slider__content">
                    <h2 class="slider__title title">Meetup for <br/>Professionals</h2>
                    <p>Go on valuable professional dates.</p>
                </div>
            </div>
            <div class="slider__item slider__item_second">
                <div class="slider__content">
                    <h2 class="slider__title title">No Fake Data <br/>Here</h2>
                    <p>Meetup with validated people only.</p>
                </div>
            </div>
            <div class="slider__item slider__item_third">
                <div class="slider__content">
                    <h2 class="slider__title title">Just Be <br/>Yourself </h2>
                    <p>
                        Meetup for Career Advice<br />
                        or Business Networking.
                    </p>
                </div>
            </div>
            <div class="slider__item slider__item_fourth">
                <div class="slider__content">
                    <h2 class="slider__title title">
                        It’s Who You <br/>Know
                    </h2>
                    <p>
                        80% of businesses and jobs are closed<br />
                        through recommendations.
                    </p>
                </div>
                <a href="{{url('/sign-up')}}" class="btn btn-violet slider__btn">Continue</a>
            </div>
        </div>
    </main>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
