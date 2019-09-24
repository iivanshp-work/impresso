@extends("frontend.layouts.app")

@section("htmlheader_title")
    Meetup Invite
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4 class="header-title">Meetup Invite</h4>
            <a href="{{url('/notifications')}}" class="header__icon-right">
                <img src="{{asset('img/icons/bell.svg')}}" alt="">
                @php
                    $hasNewNotifications = $user->has_new_notifications;
                @endphp
                @if($hasNewNotifications)
                    <img src="{{asset('img/icons/exclamation-mark.svg')}}" alt="" class="bell-exclamation">
                @endif
            </a>
            <a href="{{url()->previous() != url()->current() ? url()->previous() : url('/profile/' . $userData->id)}}" class="header__icon-left">
                <img src="{{asset('img/icons/arrow-back.svg')}}" alt="arrow-back">
            </a>
        </header>
        <main>
            <div class="meetup meetup-wrapper waiting-invite">
                <p class="text-center">Choose a reason to Meetup</p>
                <div class="meetup__user d-flex align-items-center justify-content-between">
                    <div class="meetup__circle">
                        <a href="{{url('/profile')}}" class="meetup__avatar">
                            @if($user->photo)
                                <img src="{{url('/files/' . $user->photo . '?s=200')}}" alt="@if($user->name){{$user->name}}@else{{$user->email}}@endif"/>
                            @else
                                <img src="{{asset('img/icons/icon-user.png')}}" alt="@if($user->name){{$user->name}}@else{{$user->email}}@endif"/>
                            @endif
                        </a>
                    </div>
                    <div>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                    <img src="{{asset('img/icons/meetup-icon.svg')}}" alt="" class="meetup__icon" />
                    <div class="waiting">
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                    <div class="meetup__circle meetup__circle_right">
                        <a href="{{url('/profile/' . $userData->id)}}" class="meetup__avatar">
                            @if($userData->photo)
                                <img src="{{url('/files/' . $userData->photo . '?s=200')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
                            @else
                                <img src="{{asset('img/icons/icon-user.png')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
                            @endif
                        </a>
                    </div>
                </div>
                <ul class="meetup__list">
                    @if ($reasons)
                        @foreach($reasons as $reason)
                            <li data-meetup-reason-id="{{$reason->id}}">{{$reason->title}}
                                <span class="invite">
                                    <img src="{{asset('img/icons/checked-circle-violet.svg')}}" alt="">
                                </span>
                            </li>
                        @endforeach
                    @else
                        <li class="text-center">Meetup not allowed. Please, try again later and contact support.</li>
                    @endif
                </ul>
                <form data-meetup-form="">
                    <input type="hidden" data-meetup-reason="" name="meetup_reason" value="">
                    <button type="submit" data-meetup-submit="" class="btn btn-violet btn-meetup">Meetup</button>
                </form>
            </div>
        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('popups')

    <div class="modal-window" id="meetupCost" data-meetupCost-popup="">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <p>A Meetup will cost you {{LAConfigs::getByKey('invite_xims_amount')}} XIMs. </p>
                <p>Once the Meetup is accepted,  your mobile numbers will also be exchanged.</p>
                <button type="button" class="btn btn-violet" data-submit-meetup-invite-btn="">
                    Continue
                </button>
                <button type="button" class="btn btn-border close-modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <button class="btn btn-violet open-pop-up hide" btn-meetupCost-popup="" data-target="#meetupCost">Meetup will cost</button>

    <div class="modal-window" id="meetupInvite" data-meetupInviteSuccess-popup="">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <img src="{{asset('img/icons/like.png')}}" alt="like" class="modal-window__img-top" />
                <h3 class="title">Awesome!</h3>
                <p>Once your invite is accepted you can organize your meetup date.</p>
                <a href="{{url('/profile/' . $userData->id)}}" class="btn btn-violet">
                    Close
                </a>
            </div>
        </div>
    </div>
    <button class="btn btn-violet open-pop-up hide" btn-meetupInviteSuccess-popup="" data-target="#meetupInvite">Meetup invite</button>

    <div class="modal-window" id="notHaveMixs" data-notHaveXims-popup="">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <h3 class="mb-34">Uh-oh!</h3>
                <p>
                    Looks like you don’t have enough XIMs.
                </p>
                <a href="{{url('/settings/credits')}}" type="button" class="btn btn-violet">
                    Buy XIMs
                </a>
                <button type="button" class="btn btn-border close-modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <button class="btn btn-violet open-pop-up hide" btn-notHaveXims-popup="" data-target="#notHaveMixs">Don't have XIMs</button>

@endpush

@push('styles')
@endpush

@push('scripts')
@endpush
