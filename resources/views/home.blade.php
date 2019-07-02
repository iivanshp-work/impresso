@extends("frontend.layouts.app")

@section("htmlheader_title")
    @lang('main.header_title')
@endsection

@section("news-line")
    @include('frontend.layouts.partials.news_line')
@endsection

@section("main-content")
    Test
    slider
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush