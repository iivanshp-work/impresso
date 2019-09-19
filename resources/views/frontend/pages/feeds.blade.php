@extends("frontend.layouts.app")

@section("htmlheader_title")
    Feed
@endsection

@section("main-content")
    <div class="main feed">
        <header class="header">
            <h4>Feed</h4>
            <a href="{{url('/notifications')}}" class="header__icon-right">
                <img src="{{asset('img/icons/bell.svg')}}" alt="">
                @php
                    $user = Auth::user();
                    $hasNewNotifications = $user->has_new_notifications;
                @endphp
                @if($hasNewNotifications)
                    <img src="{{asset('img/icons/exclamation-mark.svg')}}" alt="" class="bell-exclamation">
                @endif
            </a>
        </header>
        <main>
            <div class="tabs-block">
                <ul class="tab-navigation">
                    {{--<li class="tab-navigation__item active" data-feeds-tab="" data-ftype="jobs">
                        Jobs
                    </li>--}}
                    <li class="tab-navigation__item active" data-feeds-tab="" data-ftype="promos">
                        Promos
                    </li>
                    <li class="tab-navigation__item tab-navigation__item_right" data-feeds-tab="" data-ftype="professionals">
                        Professionals
                    </li>
                </ul>
                <div class="search">
                    <form data-feeds-search-form="" >
                        <input data-feeds-search-type="" type="hidden" name="type" value="jobs">
                        <input data-feeds-search-page="" type="hidden" name="page" value="2">
                        <input autocomplete="off" data-feeds-search-keyword="" type="search" name="keyword" value="" class="gray-input" placeholder="Search">
                    </form>
                </div>
                <div class="tab-content">
                    {{--<div class="tab-content__item open jobs-wrapper">
                        @include('frontend.pages.includes.feeds_jobs_items')
                    </div>--}}

                    <div class="tab-content__item open promos-wrapper">
                        @include('frontend.pages.includes.feeds_promos_items')
                    </div>
                    <div class="tab-content__item professionals-wrapper">
                        @include('frontend.pages.includes.feeds_professionals_items')
                    </div>
                </div>
            </div>
        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('popups')
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush
