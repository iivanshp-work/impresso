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
                        <div class="cards cards-jobs">
                            <div class="cards-jobs__avatar">
                                <img src="img/avatars/color-5.png" alt="">
                            </div>
                            <div class="cards-jobs__detail">
                                <a href="#">Graphic Designer</a>
                                <div>
                                    <span>Full Time</span>
                                    <span>Stockholm, SE</span>
                                </div>
                                <a href="#" class="cards-jobs__company">@ Sundström Studio</a>
                            </div>
                        </div>
                        <div class="cards cards-jobs bg-violet-gradient">
                            <p>Your CV makes money.<br />
                                What about you?</p>
                            <span class="icon icon_top">Ad</span>
                            <span class="icon icon_bottom"><img src="img/icons/logo-impresso-labs.png" alt=""></span>
                        </div>
                    </div>
                    <div class="tab-content__item">

                        <div class="cards cards-professionals">
                            <div class="cards-professionals__header">
                                <div class="cards-professionals__avatar checked">
                                    <a href="#" class="avatar">
                                        <img src="img/avatars/user-3.png" alt="">
                                    </a>
                                </div>
                                <div class="cards-professionals__info">
                                    <a href="#">Victor McCormick</a>
                                    <div class="d-flex justify-content-between">
                                        <span>Project Manager</span>
                                        <span>NYC</span>
                                    </div>
                                    <span>@ Awesome Company</span>
                                </div>
                            </div>
                            <ul class="cards-professionals__desc">
                                <li>
                                    <span>Top Skills / Area of Interest</span>
                                    <ul class="list-type-circle">
                                        <li>Investment</li>
                                        <li>Photography</li>
                                        <li>Blockchain Technology</li>
                                    </ul>
                                </li>
                                <li>
                                    <span>IMPRESSIVE BIO:</span>
                                    <div class="border-violet">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                </li>
                                <li>
                                    <p>Bachelor of Science (Physiotherapy) <span><img src="img/icons/checked.svg"
                                                                                      alt="checked"></span></p>
                                    <p>University of Copenhagen <span><img src="img/icons/checked.svg"
                                                                           alt="checked"></span></p>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-border">Meetup</a>
                        </div>
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
