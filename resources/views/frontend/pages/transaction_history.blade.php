@extends("frontend.layouts.app")

@section("htmlheader_title")
    Transaction History
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4 class="header-title">Transaction History</h4>
            @php
                $currentUrl = Session::has('current') ? Session::get('current') : url()->current();
                $previousUrl = Session::has('previous') ? Session::get('previous') : url()->previous();
            @endphp
            <a href="{{$previousUrl != $currentUrl ? $previousUrl : url('/profile')}}" class="header__icon-left">
                <img src="{{url('img/icons/arrow-back.svg')}}" alt="arrow-back">
            </a>
            <a href="{{url('/notifications')}}" class="header__icon-right">
                <img src="{{asset('img/icons/bell.svg')}}" alt="" />
                @php
                    $user = Auth::user();
                    $hasNewNotifications = $user->has_new_notifications;
                @endphp
                @if($hasNewNotifications)
                    <img src="{{asset('img/icons/exclamation-mark.svg')}}" alt="" class="bell-exclamation">
                @endif
            </a>
        </header>
        <main class="dashboard">
            <h1 class="title text-center">
                {{$user->credits_count}} {{getenv('CREDITS_LABEL')}}
                <button type="button" class="dashboard__btn open-pop-up" data-target="#infoAboutXims">
                    <img src="{{asset('img/icons/icon-info.svg')}}" alt="icon info">
                </button>
            </h1>
            @if($userTransactions)
                <a href="{{url('/settings/credits')}}" class="btn btn-violet">Buy {{getenv('CREDITS_LABEL')}}</a>
                @foreach($userTransactions as $userTransaction)
                    <div class="cards dashboard__card">
                        <div class="dashboard__header">
                            <span class="dashboard__date">{{Carbon::parse($userTransaction->created_at)->format('j M, Y')}}</span>
                            <span class="arrow-down"><img src="{{asset('img/icons/arrow-down.svg')}}" alt="arrow-down" /></span>
                            <div class="dashboard__info" data-id="{{$userTransaction->id}}" data-type="{{$userTransaction->type}}">
                                <a href="#" class="dashboard__avatar">
                                    @php
                                        $imageColor = ($userTransaction->id % 13) + 1;
                                    @endphp
                                    @if (in_array($userTransaction->type, ['user_validation', 'purchase', 'share', 'validation_education', 'validation_certificate', 'validation_resume', 'other']))
                                        <img src="{{asset('img/logo-circle.png')}}" alt="" />
                                    @elseif(in_array($userTransaction->type, ['meetup_inviting', 'meetup_accept', 'meetup_declined']))
                                        @if ($userTransaction->type == "meetup_inviting")
                                            @if ($userTransaction->meetup->invitedUser && $userTransaction->meetup->invitedUser->photo)
                                                <img src="{{url('/files/' . $userTransaction->meetup->invitedUser->photo . '?s=200')}}" alt="" />
                                            @else
                                                <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                            @endif
                                        @elseif ($userTransaction->type == "meetup_declined")
                                            @if ($userTransaction->meetup->invitedUser && $userTransaction->meetup->invitedUser->photo)
                                                <img src="{{url('/files/' . $userTransaction->meetup->invitedUser->photo . '?s=200')}}" alt="" />
                                            @else
                                                <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                            @endif
                                        @else
                                            @if ($userTransaction->meetup->invitingUser && $userTransaction->meetup->invitingUser->photo)
                                                <img src="{{url('/files/' . $userTransaction->meetup->invitingUser->photo . '?s=200')}}" alt="" />
                                            @else
                                                <img src="{{asset('img/icons/icon-user.png')}}" alt="" />
                                            @endif
                                        @endif
                                    @else
                                        <img src="{{asset('img/avatars/color-' . $imageColor . '.png')}}" alt="" />
                                    @endif
                                </a>
                                <div class="dashboard__text">
                                    @if($userTransaction->type == 'user_validation')
                                        <a href="javascript:void(0);">{{'IMPRESSO'}}</a>
                                    @elseif($userTransaction->type == 'purchase')
                                        <a href="javascript:void(0);">{{'IMPRESSO'}} <span>{{'Your Purchase'}}</span></a>
                                    @elseif($userTransaction->type == 'share')
                                        <a href="javascript:void(0);">{{'IMPRESSO'}} <span>{{'Share'}}</span></a>
                                    @elseif($userTransaction->type == 'validation_education')
                                        @if($userTransaction->education)
                                            <a href="javascript:void(0);">{{ str_limit($userTransaction->education->title, 15) }} <span>Education Validation</span></a>
                                        @else
                                            <a href="javascript:void(0);">{{'IMPRESSO'}} <span>Education Validation</span></a>
                                        @endif
                                    @elseif($userTransaction->type == 'validation_certificate')
                                        @if($userTransaction->certificate)
                                            <a href="javascript:void(0);">{{ str_limit($userTransaction->certificate->title, 15) }} <span>Certificate Validation</span></a>
                                        @else
                                            <a href="javascript:void(0);">{{'IMPRESSO'}} <span>Certificate Validation</span></a>
                                        @endif
                                    @elseif($userTransaction->type == 'validation_resume')
                                        @if($userTransaction->resume)
                                            <a href="javascript:void(0);">{{ str_limit($userTransaction->resume->title, 15) }} <span>CV/Resume Verification</span></a>
                                        @else
                                            <a href="javascript:void(0);">{{'IMPRESSO'}} <span>CV/Resume Verification</span></a>
                                        @endif
                                    @elseif($userTransaction->type == 'meetup_inviting')
                                        <a href="{{url('/profile/' . $userTransaction->meetup->user_id_invited)}}">{{$userTransaction->meetup->invitedUser ? ($userTransaction->meetup->invitedUser->name ? $userTransaction->meetup->invitedUser->name :$userTransaction->meetup->invitedUser->email) : ('Profile #' . $userTransaction->meetup->user_id_invited ) }} {!!$userTransaction->meetup->invitedUser && $userTransaction->meetup->invitedUser->job_title ? '<span>' . $userTransaction->meetup->invitedUser->job_title . '</span>' : ''!!}</a>
                                    @elseif($userTransaction->type == 'meetup_accept')
                                        <a href="{{url('/profile/' . $userTransaction->meetup->user_id_inviting)}}">{{$userTransaction->meetup->invitingUser ? ($userTransaction->meetup->invitingUser->name ? $userTransaction->meetup->invitingUser->name :$userTransaction->meetup->invitingUser->email) : ( 'Profile #' . $userTransaction->meetup->user_id_inviting ) }} {!!$userTransaction->meetup->invitingUser && $userTransaction->meetup->invitingUser->job_title ? '<span>' . $userTransaction->meetup->invitingUser->job_title . '</span>' : ''!!}</a>
                                    @elseif($userTransaction->type == 'meetup_declined')
                                        <a href="{{url('/profile/' . $userTransaction->meetup->user_id_invited)}}">{{$userTransaction->meetup->invitedUser ? ($userTransaction->meetup->invitedUser->name ? $userTransaction->meetup->invitedUser->name :$userTransaction->meetup->invitedUser->email) : ('Profile #' . $userTransaction->meetup->user_id_invited ) }} {!!$userTransaction->meetup->invitedUser && $userTransaction->meetup->invitedUser->job_title ? '<span>' . $userTransaction->meetup->invitedUser->job_title . '</span>' : ''!!}</a>
                                    @elseif($userTransaction->type == 'other')
                                        <a href="javascript:void(0);">{{'IMPRESSO'}}</a>
                                    @endif
                                    <small>{{Carbon::parse($userTransaction->created_at)->format('H:i')}}</small>
                                </div>
                                <p>@if($userTransaction->amount > 0)+@elseif($userTransaction->amount < 0)-@endif @if($userTransaction->amount >= 0){{$userTransaction->amount}} @else {{str_replace('-', '', (string)$userTransaction->amount)}} @endif {{getenv('CREDITS_LABEL')}}</p>
                            </div>
                        </div>
                        <div class="dashboard__body">
                            @if($userTransaction->type == 'user_validation')
                                <p>You have received {{$userTransaction->amount}} XIMs for joining IMPRESSO.</p>
                            @elseif($userTransaction->type == 'purchase')
                                <p>You have purchased {{$userTransaction->amount}} XIMs.</p>
                            @elseif($userTransaction->type == 'share')
                                <p>Share IMPRESSO</p>
                            @elseif($userTransaction->type == 'validation_education')
                                @if($userTransaction->education)
                                    <p>Education validation: {{$userTransaction->education->title}}</p>
                                @else
                                    <p>Education validation</p>
                                @endif
                            @elseif($userTransaction->type == 'validation_certificate')
                                @if($userTransaction->certificate)
                                    <p>Certificate validation: {{$userTransaction->certificate->title}}</p>
                                @else
                                    <p>Certificate validation</p>
                                @endif
                            @elseif($userTransaction->type == 'validation_resume')
                                @if($userTransaction->resume)
                                    <p>CV/Resume verification: {{$userTransaction->resume->title}}</p>
                                @else
                                    <p>CV/Resume verification</p>
                                @endif
                            @elseif($userTransaction->type == 'meetup_inviting')
                                <p>You have used {{abs($userTransaction->amount)}} XIMS  for inviting {{$userTransaction->meetup->invitedUser ? ($userTransaction->meetup->invitedUser->name ? $userTransaction->meetup->invitedUser->name : $userTransaction->meetup->invitedUser->email) : ('Profile #' . $userTransaction->meetup->user_id_invited)}} to Meetup.</p>
                                <p>Meetup: {{$userTransaction->meetup->statusLabel}}</p>
                            @elseif($userTransaction->type == 'meetup_accept')
                                <p>You have received {{abs($userTransaction->amount)}} XIMS from {{$userTransaction->meetup->invitingUser ? ($userTransaction->meetup->invitingUser->name ? $userTransaction->meetup->invitingUser->name : $userTransaction->meetup->invitingUser->email) : ('Profile #' . $userTransaction->meetup->user_id_inviting)}} for accepting his Meetup invitation.</p>
                                <p>Meetup: {{$userTransaction->meetup->statusLabel}}</p>
                            @elseif($userTransaction->type == 'meetup_declined')
                                <p>You have received back {{abs($userTransaction->amount)}} XIMS, due to Meetup rejection. @if($userTransaction->notes == "meetup_expired"){{'(Expired)'}}@endif</p>
                                <p>Meetup: {{$userTransaction->meetup->statusLabel}}</p>
                            @elseif($userTransaction->type == 'other')
                                <p>{{$userTransaction->notes}}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <a href="{{url('/settings/credits')}}" class="btn btn-violet">Buy {{getenv('CREDITS_LABEL')}}</a>
                <p class="dashboard__not">No transaction history yet.</p>
            @endif

        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('popups')
    <!-- modal window -->
    <div class="modal-window" id="infoAboutXims">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <h2>What are XIMs?</h2>
                <p>XIMs are Credits</p>
                <p>You can use XIMs for meetups and for document validation.</p>
                <p>You also earn XIMs when you first sign up and when you go to a meetup !</p>
                <button type="button" class="btn btn-border close-modal">
                    Got it!
                </button>
            </div>
        </div>
    </div>
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush
