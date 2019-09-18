@extends("frontend.layouts.app")

@section("htmlheader_title")
    Notifications
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4>Notifications</h4>
            <a href="{{url('/notifications')}}" class="header__icon-right icon-bell">
                <img src="{{asset('img/icons/arror-circle.svg')}}" alt="arror-circle" />
            </a>
            <a href="{{url()->previous()}}" class="header__icon-left">
                <img src="{{asset('img/icons/arrow-back.svg')}}" alt="arrow-back" />
            </a>
        </header>
        <main>
            @if($notifications)
                <div class="notifications">
                    {{--
                    <div class="cards notifications__card">
                        <div class="notifications__header">
                            <div class="notifications__arrow d-flex justify-content-between">
                                11 Jan, 2019
                                <img src="img/icons/arrow-down.svg" alt="">
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="avatar">
                                    <img src="img/avatars/user-1.png" alt="" />
                                </a>
                                <p>Lilly Barton | Meetup Accepted! <span>16:09</span></p>
                            </div>
                        </div>
                        <div class="notifications__body">
                            <a href="#" class="d-flex align-items-center justify-content-between">+41 797 97 20 65
                                <img src="img/icons/phone-violet.svg" alt="">
                            </a>
                            <p>Click to call and decide upon the time and date of your Meetup.</p>
                        </div>
                    </div>

                    <div class="cards notifications__card">
                        <div class="notifications__header">
                            <div class="notifications__arrow d-flex justify-content-between">
                                11 Jan, 2019
                                <img src="img/icons/arrow-down.svg" alt="">
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="avatar">
                                    <img src="img/avatars/user-3.png" alt="" />
                                </a>
                                <p>Lilly Barton | Meetup Accepted! <span>16:09</span></p>
                            </div>
                        </div>
                        <div class="notifications__body">
                            <span>Reason for invite:</span>
                            <p>Asking for advice</p>
                            <p>Accept to receive 24 XIMs.</p>
                        </div>
                    </div>--}}

                    @foreach($notifications as $notification)
                        <div class="cards notifications__card" data-type="{{isset($notification->type) ? $notification->type : 'admin_general_not'}}">
                            <div class="notifications__header">
                                <div class="notifications__arrow d-flex justify-content-between">
                                    @if($notification->created_at)
                                        @if (Carbon::parse($notification->created_at)->timestamp > Carbon::now()->subDays(1)->startOfDay()->timestamp)
                                                @php
                                                    Carbon::setHumanDiffOptions(Carbon::ONE_DAY_WORDS);
                                                @endphp
                                                {{Carbon::parse($notification->created_at)->diffForHumans()}}
                                            @else
                                                @if (Carbon::parse($notification->created_at)->format('Y') == Carbon::now()->format('Y'))
                                                    {{Carbon::parse($notification->created_at)->format('j M, Y')}}
                                                @else
                                                    {{Carbon::parse($notification->created_at)->format('j M, Y')}}
                                                @endif
                                            @endif
                                    @endif
                                    {{--@if ($notification->type == 'meetup_wants' || $notification->type == 'meetup_accepted')
                                        <img src="{{asset('img/icons/arrow-down.svg')}}" alt="">
                                    @endif--}}
                                </div>
                                @if(isset($notification->user_id))
                                    @if ($notification->type == 'no_xims')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/settings/credits')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/settings/credits')}}"></a>
                                    @elseif ($notification->type == 'education_validation_failure')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/profile')}}"></a>
                                    @elseif ($notification->type == 'education_validation_success')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/profile')}}"></a>
                                    @elseif ($notification->type == 'certificate_validation_failure')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/profile')}}"></a>
                                    @elseif ($notification->type == 'certificate_validation_success')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/profile')}}"></a>
                                    @elseif ($notification->type == 'xim_purchase_complete')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/transaction-history')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/transaction-history')}}"></a>
                                    @elseif ($notification->type == 'new_job')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/feeds')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/feeds')}}"></a>
                                    @elseif ($notification->type == 'user_validation_success')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/feeds')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/feeds')}}"></a>
                                    @elseif ($notification->type == 'admin_manual')
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                {!!nl2br($notification->notification_text)!!} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                    @elseif ($notification->type == 'meetup_wants')
                                    @elseif ($notification->type == 'meetup_accepted')
                                    @elseif ($notification->type == 'app_rating')
                                    @endif
                                @else
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar">
                                            <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                        </a>
                                        <div>
                                            {!!$notification->notification_text!!} @if($notification->created_at)<p><span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span></p>@endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h1 class="title text-center no-records" style="padding: 20px 0;">There are no records yet.</h1>
            @endif
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
