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
            @php
                $currentUrl = Session::has('current') ? Session::get('current') : url()->current();
                $previousUrl = Session::has('previous') ? Session::get('previous') : url()->previous();
            @endphp
            <a href="{{$previousUrl != $currentUrl ? $previousUrl : url('/profile')}}" class="header__icon-left">
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
                        <div class="cards notifications__card meetup-accepted" data-type="{{isset($notification->type) ? $notification->type : 'admin_general_not'}}">
                            <div class="notifications__header">
                                <div class="notifications__arrow d-flex justify-content-between">
                                    @if($notification->created_at)
                                        @if (Carbon::parse($notification->created_at)->timestamp > Carbon::now()->subDays(1)->startOfDay()->timestamp)
                                            @php
                                                Carbon::setHumanDiffOptions(Carbon::ONE_DAY_WORDS);
                                            @endphp
                                            {{Carbon::parse($notification->created_at)->diffForHumans()}}
                                        @else
                                            {{Carbon::parse($notification->created_at)->format('j M, Y')}}
                                        @endif
                                    @endif
                                    <img src="{{asset('img/icons/arrow-down.svg')}}" alt="">
                                </div>
                                <div class="d-flex">
                                    @if(isset($notification->user_id))
                                        @if ($notification->type == 'no_xims')
                                            <a href="{{url('/settings/credits')}}" class="avatar">
                                                <img src="{{asset('img/Logo.png')}}" alt="Impresso" />
                                            </a>
                                            <div class="notifications__info">
                                                <a href="#">IMPRESSO</a>
                                                <p>Don’t have enough XIMs</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                            <a class="full-link" href="{{url('/settings/credits')}}"></a>
                                        @elseif ($notification->type == 'education_validation_failure' || $notification->type == 'education_validation_success' || $notification->type == 'certificate_validation_failure' || $notification->type == 'certificate_validation_success' || $notification->type == 'resume_validation_failure' || $notification->type == 'resume_validation_success')
                                            <a href="{{url('/profile')}}" class="avatar">
                                                <img src="{{asset('img/Logo.png')}}" alt="Impresso" />
                                            </a>
                                            <div class="notifications__info">
                                                <a href="#">IMPRESSO</a>
                                                <p>{{$notification->notification_text}}</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                            <a class="full-link" href="{{url('/profile')}}"></a>
                                        @elseif ($notification->type == 'xim_purchase_complete')
                                            <a href="{{url('/transaction-history')}}" class="avatar">
                                                <img src="{{asset('img/Logo.png')}}" alt="Impresso" />
                                            </a>
                                            <div class="notifications__info">
                                                <a href="#">IMPRESSO</a>
                                                <p>{{$notification->notification_text}}</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                            <a class="full-link" href="{{url('/transaction-history')}}"></a>
                                        @elseif ($notification->type == 'new_job')
                                            <a href="{{url('/feeds')}}" class="avatar">
                                                <img src="{{asset('img/Logo.png')}}" alt="Impresso" />
                                            </a>
                                            <div class="notifications__info">
                                                <a href="#">IMPRESSO</a>
                                                <p>{{$notification->notification_text}}</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                            <a class="full-link" href="{{url('/feeds')}}"></a>
                                        @elseif ($notification->type == 'user_validation_success')
                                            <a href="{{url('/feeds')}}" class="avatar">
                                                <img src="{{asset('img/Logo.png')}}" alt="Impresso" />
                                            </a>
                                            <div class="notifications__info">
                                                <a href="#">IMPRESSO</a>
                                                <p>Profile Verified</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                            <a class="full-link" href="{{url('/feeds')}}"></a>
                                        @elseif ($notification->type == 'admin_manual')
                                            <a href="javascript:void(0);" class="avatar">
                                                <img src="{{asset('img/Logo.png')}}" alt="Impresso" />
                                            </a>
                                            <div class="notifications__info">
                                                <a href="#">IMPRESSO</a>
                                                <p>Service Notification</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                        @elseif ($notification->type == 'meetup_wants')
                                            <a href="{{url('/profile/' . $meetup->user_id_inviting)}}" class="avatar">
                                                @if ($meetup->invitingUser && $meetup->invitingUser->photo)
                                                    <img src="{{url('/files/' . $meetup->invitingUser->photo . '?s=200')}}" alt="" />
                                                @else
                                                    <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                @endif
                                            </a>
                                            <div class="notifications__info">
                                                <a href="{{url('/profile/' . $meetup->user_id_inviting)}}">{{$meetup->invitingUser ? ($meetup->invitingUser->name ? $meetup->invitingUser->name : $meetup->invitingUser->email) : ('Profile #' . $meetup->user_id_inviting)}}</a>
                                                <p>Meetup Invitation</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                        @elseif ($notification->type == 'meetup_accepted')
                                            @if ($user->id == $meetup->user_id_invited)
                                                <a href="{{url('/profile/' . $meetup->user_id_inviting)}}" class="avatar">
                                                    @if ($meetup->invitingUser && $meetup->invitingUser->photo)
                                                        <img src="{{url('/files/' . $meetup->invitingUser->photo . '?s=200')}}" alt="" />
                                                    @else
                                                        <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                    @endif
                                                </a>
                                                <div class="notifications__info">
                                                    <a href="{{url('/profile/' . $meetup->user_id_inviting)}}">{{$meetup->invitingUser ? ($meetup->invitingUser->name ? $meetup->invitingUser->name : $meetup->invitingUser->email) : ('Profile #' . $meetup->user_id_inviting)}}</a>
                                                    <p>Meetup Accepted!</p>
                                                    @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                                </div>
                                            @else
                                                <a href="{{url('/profile/' . $meetup->user_id_invited)}}" class="avatar">
                                                    @if ($meetup->invitedUser && $meetup->invitedUser->photo)
                                                        <img src="{{url('/files/' . $meetup->invitedUser->photo . '?s=200')}}" alt="" />
                                                    @else
                                                        <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                    @endif
                                                </a>
                                                <div class="notifications__info">
                                                    <a href="{{url('/profile/' . $meetup->user_id_invited)}}">{{$meetup->invitedUser ? ($meetup->invitedUser->name ? $meetup->invitedUser->name : $meetup->invitedUser->email) : ('Profile #' . $meetup->user_id_invited)}}</a>
                                                    <p>Meetup Accepted!</p>
                                                    @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                                </div>
                                            @endif
                                        @elseif ($notification->type == 'meetup_declined')
                                            <a href="{{url('/profile/' . $meetup->user_id_invited)}}" class="avatar">
                                                @if ($meetup->invitedUser && $meetup->invitedUser->photo)
                                                    <img src="{{url('/files/' . $meetup->invitedUser->photo . '?s=200')}}" alt="" />
                                                @else
                                                    <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                @endif
                                            </a>
                                            <div class="notifications__info">
                                                <a href="{{url('/profile/' . $meetup->user_id_invited)}}">{{$meetup->invitedUser ? ($meetup->invitedUser->name ? $meetup->invitedUser->name : $meetup->invitedUser->email) : ('Profile #' . $meetup->user_id_invited)}}</a>
                                                <p>Meetup was not accepted!</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                        @elseif ($notification->type == 'meetup_expired')
                                            <a href="{{url('/profile/' . $meetup->user_id_invited)}}" class="avatar">
                                                @if ($meetup->invitedUser && $meetup->invitedUser->photo)
                                                    <img src="{{url('/files/' . $meetup->invitedUser->photo . '?s=200')}}" alt="" />
                                                @else
                                                    <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                                @endif
                                            </a>
                                            <div class="notifications__info">
                                                <a href="{{url('/profile/' . $meetup->user_id_invited)}}">{{$meetup->invitedUser ? ($meetup->invitedUser->name ? $meetup->invitedUser->name : $meetup->invitedUser->email) : ('Profile #' . $meetup->user_id_invited)}}</a>
                                                <p>Expired Invitation</p>
                                                @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                            </div>
                                        @elseif ($notification->type == 'app_rating')
                                        @endif
                                    @else
                                        <a href="javascript:void(0);" class="avatar">
                                            <img src="{{asset('img/Logo.png')}}" alt="Impresso" />
                                        </a>
                                        <div class="notifications__info">
                                            <a href="#">IMPRESSO</a>
                                            <p>Service Notification</p>
                                            @if($notification->created_at)<small>{{Carbon::parse($notification->created_at)->format('H:i')}}</small>@endif
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @if (isset($notification->type))
                                @if ($notification->type == 'no_xims')
                                    <div class="notifications__body">
                                        <p>Looks like you don’t have enough XIMs. {{$notification->notification_text}}.</p>
                                    </div>
                                @elseif ($notification->type == 'education_validation_failure')
                                    <div class="notifications__body">
                                        <p>Your education validation was failed. Please try again. The more complete your profile the more likely is validation to be approved.</p>
                                    </div>
                                @elseif ($notification->type == 'education_validation_success')
                                    <div class="notifications__body">
                                        <p>Your education validation was approved. The more complete your profile the more likely is an invite to be accepted.</p>
                                    </div>
                                @elseif ($notification->type == 'certificate_validation_failure')
                                    <div class="notifications__body">
                                        <p>Your certificate validation was failed. Please try again. The more complete your profile the more likely is validation to be approved.</p>
                                    </div>
                                @elseif ($notification->type == 'certificate_alidation_success')
                                    <div class="notifications__body">
                                        <p>Your certificate validation was approved. The more complete your profile the more likely is an invite to be accepted.</p>
                                    </div>
                                @elseif ($notification->type == 'xim_purchase_complete')
                                    <div class="notifications__body">
                                        <p>You have purchased XIMs.You can use XIMs for meetups and for document validation.</p>
                                    </div>

                                @elseif ($notification->type == 'user_validation_success')
                                    <div class="notifications__body">
                                        <p>Start your Meetup now!</p>
                                    </div>
                                @elseif ($notification->type == 'admin_manual')
                                    <div class="notifications__body">
                                        <p>{!! $notification->notification_text !!}.</p>
                                    </div>
                                @elseif ($notification->type == 'meetup_wants')
                                    <div class="notifications__body">
                                        @if ($meetup->meetupReason->title)
                                            <p>Reason for invite: {{$meetup->meetupReason->title}}</p>
                                        @endif
                                        <p>Accept to receive {{$notification->notification_text}} XIMs.</p>
                                    </div>
                                @elseif ($notification->type == 'meetup_accepted')
                                    @if ($user->id == $meetup->user_id_invited)
                                        <div class="notifications__body" >
                                            @if (($meetup->invitingUser && $meetup->invitingUser->phone) || $notification->notification_text)
                                                <p>Click to call and decide upon the time and date of your Meetup.</p>
                                            @endif
                                            <a href="@if ($meetup->invitingUser && $meetup->invitingUser->phone)tel:{{$meetup->invitingUser->phone}}@elseif ($notification->notification_text)tel:{{$notification->notification_text}}@else{{"#"}}@endif" class="btn @if ($meetup->invitingUser && $meetup->invitingUser->phone) btn-violet @elseif ($notification->notification_text) btn-violet @else btn-gray @endif notifications__btn">
                                                @if ($meetup->invitingUser && $meetup->invitingUser->phone)
                                                    CALL
                                                    <span class="icon-phone"><img src="{{asset('img/icons/phone-violet.svg')}}" alt=""></span>
                                                @elseif ($notification->notification_text)
                                                    CALL
                                                    <span class="icon-phone"><img src="{{asset('img/icons/phone-violet.svg')}}" alt=""></span>
                                                @else
                                                    {{'No contact info.'}}
                                                @endif
                                            </a>
                                        </div>
                                    @else
                                        <div class="notifications__body">
                                            @if (($meetup->invitedUser && $meetup->invitedUser->phone) || $notification->notification_text)
                                                <p>Click to call and decide upon the time and date of your Meetup.</p>
                                            @endif
                                            <a href="@if ($meetup->invitedUser && $meetup->invitedUser->phone)tel:{{$meetup->invitedUser->phone}}@elseif ($notification->notification_text)tel:{{$notification->notification_text}}@else{{"#"}}@endif" class="btn @if ($meetup->invitedUser && $meetup->invitedUser->phone) btn-violet @elseif ($notification->notification_text) btn-violet @else btn-gray @endif notifications__btn">
                                                @if ($meetup->invitedUser && $meetup->invitedUser->phone)
                                                    CALL
                                                    <span class="icon-phone"><img src="{{asset('img/icons/phone-violet.svg')}}" alt=""></span>
                                                @elseif ($notification->notification_text)
                                                    CALL
                                                    <span class="icon-phone"><img src="{{asset('img/icons/phone-violet.svg')}}" alt=""></span>
                                                @else
                                                    {{'No contact info.'}}
                                                @endif
                                            </a>
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
                            @else
                                <div class="notifications__body">
                                    <p>{!! $notification->notification_text !!}</p>
                                </div>
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
