@extends("frontend.layouts.app")

@section("htmlheader_title")
    Maintenance Mode
@endsection

@section("main-content")
    <main class="main">
        <div class="slider">
            <div class="slider__item slider__item_first">
                <div class="slider__content">
                    <h2 class="slider__title title" style="text-align: center;">Coming Soon <br> <br>We are under maintenance </h2>
                    <p>Please check back very soon.<br>Sorry for the inconvenience.</p>
                    <span class="slider__author">Photo by averie woodard on Unsplash</span>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
