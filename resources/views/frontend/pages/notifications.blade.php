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
            <a href="{{url()->previous() != url()->current() ? url()->previous() : url('/profile')}}" class="header__icon-left">
                <img src="{{asset('img/icons/arrow-back.svg')}}" alt="arrow-back" />
            </a>
        </header>
        <main>
            @if($notifications)
                <div class="notifications">
                    @foreach($notifications as $notification)
                        @php
                            if (isset($notification->type) && ($notification->type == 'meetup_wants' || $notification->type == 'meetup_accepted' || $notification->type == 'meetup_declined' || $notification->type == 'meetup_expired')) {
                                $meetup = App\Models\Meetup::find($notification->reference_id);
                                if (!$meetup) continue;
                            }
                        @endphp
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
                                    @if (isset($notification->type) && ($notification->type == 'meetup_wants' || $notification->type == 'meetup_accepted' || $notification->type == 'meetup_declined' || $notification->type == 'meetup_expired'))
                                        <img src="{{asset('img/icons/arrow-down.svg')}}" alt="" @if($notification->type == 'meetup_accepted') class="rotate"@endif>
                                    @endif
                                </div>
                                @if(isset($notification->user_id))
                                    @if ($notification->type == 'no_xims')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/settings/credits')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO | {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/settings/credits')}}"></a>
                                    @elseif ($notification->type == 'education_validation_failure')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO | {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/profile')}}"></a>
                                    @elseif ($notification->type == 'education_validation_success')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO | {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/profile')}}"></a>
                                    @elseif ($notification->type == 'certificate_validation_failure')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO | {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/profile')}}"></a>
                                    @elseif ($notification->type == 'certificate_validation_success')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO | {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/profile')}}"></a>
                                    @elseif ($notification->type == 'xim_purchase_complete')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/transaction-history')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO | {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/transaction-history')}}"></a>
                                    @elseif ($notification->type == 'new_job')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/feeds')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO | {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/feeds')}}"></a>
                                    @elseif ($notification->type == 'user_validation_success')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/feeds')}}" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO | {{$notification->notification_text}} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                        <a class="full-link" href="{{url('/feeds')}}"></a>
                                    @elseif ($notification->type == 'admin_manual')
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar">
                                                <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                            </a>
                                            <p>
                                                IMPRESSO <Br>
                                                {!!nl2br($notification->notification_text)!!} @if($notification->created_at)<span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span>@endif
                                            </p>
                                        </div>
                                    @elseif ($notification->type == 'meetup_wants')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile/' . $meetup->user_id_inviting)}}" class="avatar">
                                                @if ($meetup->invitingUser && $meetup->invitingUser->photo)
                                                    <img src="{{url('/files/' . $meetup->invitingUser->photo . '?s=200')}}" alt="" />
                                                @else
                                                    <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                @endif
                                            </a>
                                            <a href="{{url('/profile/' . $meetup->user_id_inviting)}}">
                                                <p>{{$meetup->invitingUser ? ($meetup->invitingUser->name ? $meetup->invitingUser->name : $meetup->invitingUser->email) : ('Profile #' . $meetup->user_id_inviting)}} | Meetup Invitation. <span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span></p>
                                            </a>
                                        </div>
                                    @elseif ($notification->type == 'meetup_accepted')
                                        @if ($user->id == $meetup->user_id_invited)
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('/profile/' . $meetup->user_id_inviting)}}" class="avatar">
                                                    @if ($meetup->invitingUser && $meetup->invitingUser->photo)
                                                        <img src="{{url('/files/' . $meetup->invitingUser->photo . '?s=200')}}" alt="" />
                                                    @else
                                                        <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                    @endif
                                                </a>
                                                <a href="{{url('/profile/' . $meetup->user_id_inviting)}}">
                                                    <p>{{$meetup->invitingUser ? ($meetup->invitingUser->name ? $meetup->invitingUser->name : $meetup->invitingUser->email) : ('Profile #' . $meetup->user_id_inviting)}} | Meetup Accepted! <span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span></p>
                                                </a>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center">
                                                <a href="{{url('/profile/' . $meetup->user_id_invited)}}" class="avatar">
                                                    @if ($meetup->invitedUser && $meetup->invitedUser->photo)
                                                        <img src="{{url('/files/' . $meetup->invitedUser->photo . '?s=200')}}" alt="" />
                                                    @else
                                                        <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                    @endif
                                                </a>
                                                <a href="{{url('/profile/' . $meetup->user_id_invited)}}">
                                                    <p>{{$meetup->invitedUser ? ($meetup->invitedUser->name ? $meetup->invitedUser->name : $meetup->invitedUser->email) : ('Profile #' . $meetup->user_id_invited)}} | Meetup Accepted! <span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span></p>
                                                </a>
                                            </div>
                                        @endif
                                    @elseif ($notification->type == 'meetup_declined')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile/' . $meetup->user_id_invited)}}" class="avatar">
                                                @if ($meetup->invitedUser && $meetup->invitedUser->photo)
                                                    <img src="{{url('/files/' . $meetup->invitedUser->photo . '?s=200')}}" alt="" />
                                                @else
                                                    <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                @endif
                                            </a>
                                            <a href="{{url('/profile/' . $meetup->user_id_invited)}}">
                                                <p>{{$meetup->invitedUser ? ($meetup->invitedUser->name ? $meetup->invitedUser->name : $meetup->invitedUser->email) : ('Profile #' . $meetup->user_id_invited)}} | Meetup was not accepted. <span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span></p>
                                            </a>
                                        </div>
                                    @elseif ($notification->type == 'meetup_expired')
                                        <div class="d-flex align-items-center">
                                            <a href="{{url('/profile/' . $meetup->user_id_invited)}}" class="avatar">
                                                @if ($meetup->invitedUser && $meetup->invitedUser->photo)
                                                    <img src="{{url('/files/' . $meetup->invitedUser->photo . '?s=200')}}" alt="" />
                                                @else
                                                    <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                @endif
                                            </a>
                                            <a href="{{url('/profile/' . $meetup->user_id_invited)}}">
                                                <p>{{$meetup->invitedUser ? ($meetup->invitedUser->name ? $meetup->invitedUser->name : $meetup->invitedUser->email) : ('Profile #' . $meetup->user_id_invited)}} | Expired Invitation. <span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span></p>
                                            </a>
                                        </div>
                                    @elseif ($notification->type == 'app_rating')
                                    @endif
                                @else
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar">
                                            <img src="{{asset('img/logo-circle.png')}}" alt="Impresso" />
                                        </a>
                                        <div>
                                            IMPRESSO  {!!$notification->notification_text!!} @if($notification->created_at)<p><span>{{Carbon::parse($notification->created_at)->format('H:i')}}</span></p>@endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if (isset($notification->type))
                                @if ($notification->type == 'meetup_wants')
                                    <div class="notifications__body">
                                        @if ($meetup->meetupReason->title)
                                            <span>Reason for invite:</span>
                                            <p>{{$meetup->meetupReason->title}}</p>
                                        @endif
                                        <p>Accept to receive {{$notification->notification_text}} XIMs.</p>
                                    </div>
                                @elseif ($notification->type == 'meetup_accepted')
                                    @if ($user->id == $meetup->user_id_invited)
                                        <div class="notifications__body"  style="display: block;">
                                            <a href="@if ($meetup->invitingUser && $meetup->invitingUser->phone)tel:{{$meetup->invitingUser->phone}}@elseif ($notification->notification_text)tel:{{$notification->notification_text}}@else{{"#"}}@endif" class="d-flex align-items-center justify-content-between">
                                                @if ($meetup->invitingUser && $meetup->invitingUser->phone)
                                                    {{$meetup->invitingUser->phone}}
                                                    <img src="{{asset('img/icons/phone-violet.svg')}}" alt="">
                                                @elseif ($notification->notification_text)
                                                    {{$notification->notification_text}}
                                                    <img src="{{asset('img/icons/phone-violet.svg')}}" alt="">
                                                @else
                                                    {{'No contact info.'}}
                                                @endif
                                            </a>
                                            @if (($meetup->invitingUser && $meetup->invitingUser->phone) || $notification->notification_text)
                                                <p>Click to call and decide upon the time and date of your Meetup.</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="notifications__body"  style="display: block;">
                                            <a href="@if ($meetup->invitedUser && $meetup->invitedUser->phone)tel:{{$meetup->invitedUser->phone}}@elseif ($notification->notification_text)tel:{{$notification->notification_text}}@else{{"#"}}@endif" class="d-flex align-items-center justify-content-between">
                                                @if ($meetup->invitedUser && $meetup->invitedUser->phone)
                                                    {{$meetup->invitedUser->phone}}
                                                    <img src="{{asset('img/icons/phone-violet.svg')}}" alt="">
                                                @elseif ($notification->notification_text)
                                                    {{$notification->notification_text}}
                                                    <img src="{{asset('img/icons/phone-violet.svg')}}" alt="">
                                                @else
                                                    {{'No contact info.'}}
                                                @endif
                                            </a>
                                            @if (($meetup->invitedUser && $meetup->invitedUser->phone) || $notification->notification_text)
                                                <p>Click to call and decide upon the time and date of your Meetup.</p>
                                            @endif
                                        </div>
                                    @endif
                                @elseif ($notification->type == 'meetup_declined')
                                    <div class="notifications__body">
                                        <p>Please try again. The more complete your profile the more likely is an invite to be accepted.</p>
                                    </div>
                                @elseif ($notification->type == 'meetup_expired')
                                    <div class="notifications__body">
                                        <p>Meetup invitations expire after 30 days. Your Meetup Date might have missed your invite. Don’t worry, you can now try again.</p>
                                    </div>
                                @endif
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
