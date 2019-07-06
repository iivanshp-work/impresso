@extends("frontend.layouts.app")

@section("htmlheader_title")
    Feed
@endsection

@section("main-content")
    <div class="main feed">
        <header class="header">
            <h4>Feed</h4>
            <span class="header__icon-right">
                <img src="img/icons/bell.svg" alt="">
                <img src="img/icons/exclamation-mark.svg" alt="" class="bell-exclamation">
            </span>
        </header>
        <main>
            <div class="tabs-block">
                <ul class="tab-navigation">
                    <li class="tab-navigation__item active">
                        Jobs
                    </li>
                    <li class="tab-navigation__item tab-navigation__item_right">
                        Professionals
                    </li>
                </ul>
                <div class="search">
                    <input type="search" class="gray-input" placeholder="Search">
                </div>
                <div class="tab-content">
                    <div class="tab-content__item open">
                        @include('frontend.pages.includes.feeds_jobs_items')
                    </div>
                    <div class="tab-content__item">
                        @include('frontend.pages.includes.feeds_professionals_items')
                    </div>
                </div>
            </div>
        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('popups')

    @if (app('request')->has('show_profile_setup_profile'))
        <button class="btn btn-violet open-pop-up" id="showFeedsLetStartImpressing" data-target="#letStartImpressing">
            Let's start Impressing
        </button>
        <div class="modal-window" id="letStartImpressing">
            <div class="modal-window__content">
                <div class="modal-window__body validation-modal text-center">
                    <h3 class="title mb-34">
                        Let’s start impressing!
                    </h3>
                    <p>
                        Complete your profile in order to show others how impressive you are ;)
                    </p>
                    <a href="{{url('/profile')}}" type="button" class="btn btn-violet">
                        Go to Profile
                    </a>
                    <button type="button" class="btn btn-border close-modal">
                        Do this later
                    </button>
                </div>
            </div>
        </div>
    @endif

@endpush

@push('styles')
@endpush
@push('scripts')
@endpush
