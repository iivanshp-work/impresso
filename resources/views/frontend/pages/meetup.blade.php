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
            <a href="{{url()->previous() != url()->current() ? url()->previous() : url('/profile/' . $user->id)}}" class="header__icon-left">
                <img src="{{url('img/icons/arrow-back.svg')}}" alt="arrow-back">
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
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush
