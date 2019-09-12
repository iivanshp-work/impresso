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
                    @foreach($notifications as $notification)
                        <div class="cards notifications__card">
                            @if(isset($notification->user_id))
                                @if ($notification->type == 'no_xims')
                                    <a class="full-link" href="{{url('/settings/credits')}}"></a>
                                    <p>{{$notification->notification_text}}</p>
                                @elseif ($notification->type == 'education_validation_failure')
                                    <a class="full-link" href="{{url('/profile')}}"></a>
                                    <p>{{$notification->notification_text}}</p>
                                @elseif ($notification->type == 'education_validation_success')
                                    <a class="full-link" href="{{url('/profile')}}"></a>
                                    <p>{{$notification->notification_text}}</p>
                                @elseif ($notification->type == 'certificate_validation_failure')
                                    <p>{{$notification->notification_text}}</p>
                                    <a class="full-link" href="{{url('/profile')}}"></a>
                                @elseif ($notification->type == 'certificate_validation_success')
                                    <a class="full-link" href="{{url('/profile')}}"></a>
                                    <p>{{$notification->notification_text}}</p>
                                @elseif ($notification->type == 'xim_purchase_complete')
                                    <a class="full-link" href="{{url('/transaction-history')}}"></a>
                                    <p>{{$notification->notification_text}}</p>
                                @elseif ($notification->type == 'new_job')
                                    <a class="full-link" href="{{url('/feeds')}}"></a>
                                    <p>{{$notification->notification_text}}</p>
                                @elseif ($notification->type == 'user_validation_success')
                                    <a class="full-link" href="{{url('/feeds')}}"></a>
                                    <p>{{$notification->notification_text}}</p>
                                @elseif ($notification->type == 'admin_manual')
                                    <div class="notifications__header mb-3">
                                        <a href="javascript:void(0);" class="avatar">
                                            <img src="{{ asset('/img/Logo.png') }}" alt="" />
                                        </a>
                                        <p>{!!nl2br($notification->notification_text)!!}</p>
                                    </div>
                                @elseif ($notification->type == 'meetup_wants')
                                    {{--<div class="notifications__header mb-3">
                                        <a href="#" class="avatar">
                                            <img src="img/avatars/user-3.png" alt="" />
                                        </a>
                                        <p><a href="#">Victor McComrick</a> wants to meetup.</p>
                                    </div>--}}
                                @elseif ($notification->type == 'meetup_accepted')
                                @elseif ($notification->type == 'app_rating')
                                @endif
                            @else
                                <div class="notifications__header">
                                    <p>{!!$notification->notification_text!!}</p>
                                </div>
                            @endif
                            @if($notification->created_at)
                                <span class="notifications__date">
                                    @if (Carbon::parse($notification->created_at)->timestamp > Carbon::now()->subDays(1)->startOfDay()->timestamp)
                                        @php
                                            Carbon::setHumanDiffOptions(Carbon::ONE_DAY_WORDS);
                                        @endphp
                                        {{Carbon::parse($notification->created_at)->diffForHumans()}}
                                    @else
                                        @if (Carbon::parse($notification->created_at)->format('Y') == Carbon::now()->format('Y'))
                                            {{Carbon::parse($notification->created_at)->format('D j M')}}
                                        @else
                                            {{Carbon::parse($notification->created_at)->format('D j M Y')}}
                                        @endif
                                    @endif
                                </span>
                            @endif
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
