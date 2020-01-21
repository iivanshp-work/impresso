@extends("frontend.layouts.app")

@section("htmlheader_title")
    Settings
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4 class="header-title">Credits & Copyrights</h4>
            <a href="{{url('/settings')}}" class="header__icon-left">
                <img src="{{url('img/icons/arrow-back.svg')}}" alt="arrow-back">
            </a>
        </header>
        <main class="settings settings_credits_copyrights" style="padding: 20px 15px;">
            <div class="text">
                <p class="font_7"><span style="text-decoration:underline;"><a href="https://unsplash.com/photos/4nulm-JUYFo" target="_blank" data-content="https://unsplash.com/photos/4nulm-JUYFo" data-type="external" rel="noopener noreferrer">Photo by&nbsp;</a><a href="https://unsplash.com/@averieclaire?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" target="_blank" data-content="https://unsplash.com/@averieclaire?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" data-type="external" rel="noopener noreferrer">averie woodard</a></span>&nbsp;on&nbsp;<span style="text-decoration:underline;"><a href="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" target="_blank" data-content="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" data-type="external" rel="noopener noreferrer">Unsplash</a></span></p>
                <p class="font_7"><span style="text-decoration:underline;"><a href="https://unsplash.com/photos/qJKT2rMU0VU" target="_blank" data-content="https://unsplash.com/photos/qJKT2rMU0VU" data-type="external" rel="noopener noreferrer">Photo by&nbsp;</a><a href="https://unsplash.com/@stuchy?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" target="_blank" data-content="https://unsplash.com/@stuchy?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" data-type="external" rel="noopener noreferrer">George Bohunicky</a></span>&nbsp;on&nbsp;<span style="text-decoration:underline;"><a href="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" target="_blank" data-content="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" data-type="external" rel="noopener noreferrer">Unsplash</a></span></p>
                <p class="font_7"><span style="text-decoration:underline;"><a href="https://unsplash.com/photos/OaAB-eYwmUU" target="_blank" data-content="https://unsplash.com/photos/OaAB-eYwmUU" data-type="external" rel="noopener noreferrer">Photo by&nbsp;</a><a href="https://unsplash.com/@laclem?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" target="_blank" data-content="https://unsplash.com/@laclem?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" data-type="external" rel="noopener noreferrer">Patricia Palma</a></span>&nbsp;on&nbsp;<span style="text-decoration:underline;"><a href="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" target="_blank" data-content="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" data-type="external" rel="noopener noreferrer">Unsplash</a></span></p>
                <p class="font_7"><span style="text-decoration:underline;"><a href="https://unsplash.com/photos/PVyhz0wmHdo" target="_blank" data-content="https://unsplash.com/photos/PVyhz0wmHdo" data-type="external" rel="noopener noreferrer">Photo by&nbsp;</a><a href="https://unsplash.com/@dizzyd718?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" target="_blank" data-content="https://unsplash.com/@dizzyd718?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" data-type="external" rel="noopener noreferrer">Drew Graham</a></span>&nbsp;on&nbsp;<span style="text-decoration:underline;"><a href="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" target="_blank" data-content="https://unsplash.com/?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText" data-type="external" rel="noopener noreferrer">Unsplash</a></span></p>
            </div>
        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
