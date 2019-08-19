@extends("frontend.layouts.app")

@section("htmlheader_title")
    Profile
@endsection

@section("main-content")

    <div class="main">
        <header class="header">
            <h4 class="header-title">Profile</h4>
            <span class="header__icon-right">
                @if($mode == "me")
                    <a href="{{url('/settings')}}"><img src="{{asset('img/icons/settings.svg')}}" alt="" /></a>
                @endif
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
            </span>
        </header>
        <main>
            <div class="user">

                <!--<button type="button" class="btn btn-pink" style="width: 100%;" id="subscribe">Notifications</button>-->
                <div class="user__header">
                    <div class="user__avatar">
                        @if($userData->photo)
                            <img src="{{url('/files/' . $userData->photo . '?s=200')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
                        @else
                            <img src="{{asset('img/icons/icon-user.png')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
                        @endif
                        @if($mode == "me")
                            <a href="{{url('profile/edit')}}" download class="edit-photo">edit photo</a>
                        @endif
                    </div>
                    @if($mode == "me")
                        <span class="edit-icon" id="edit-profile">
                            <a href="{{url('profile/edit')}}" class="edit-photo"><img src="{{asset('img/icons/edit.svg')}}" alt="" /></a>
                        </span>
                    @endif
                    @if($userData->is_verified)
                        <span class="user__checked">
                            <img src="{{asset('img/icons/icon-checked.svg')}}" alt="" />
                        </span>
                    @endif
                </div>
                <h4 class="user__name">@if($userData->name){{$userData->name}}@else @if ($mode == 'me'){{'Name'}}@else{{'None'}}@endif @endif</h4>
                @if ($mode == 'me')
                    <div class="job-title">
                        <span>
                            @if($userData->job_title){{$userData->job_title}}@endif
                            @if($userData->job_title && $userData->company_title){{'at'}}@endif
                            @if($userData->company_title){{$userData->company_title}}@endif
                        </span>
                    </div>
                @else
                    <div class="job-title">
                        <span>
                            @if($userData->job_title){{$userData->job_title}}@endif
                            @if($userData->job_title && $userData->company_title){{'at'}}@endif
                            @if($userData->company_title){{$userData->company_title}}@endif
                        </span>
                    </div>
                @endif
                <div class="user__info">
                    <p>
                        <img src="{{asset('img/icons/maps-and-flags.png')}}" alt="" />
                        <span class="location_title_field">@if($userData->location_title){{$userData->location_title}}@else{{'Phone location'}}@endif</span>
                    </p>
                    <p>
                        <img src="{{asset('img/icons/multiple-users-silhouette.png')}}" alt="" />
                        <a href="https://www.impresso.tech/">@if($userData->meetup_count){{$userData->meetup_count}}@else{{'0'}}@endif Meetups</a>
                    </p>
                </div>
                <div class="cards user__card">
                    <h5 class="user__card_title">Basic Information</h5>
                    <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                    <ul class="list-type-circle">
                        @if ($mode == 'me')
                            @if (!$userData->company_title && !$userData->job_title && !$userData->university_title && !$userData->certificate_title)
                                <li>
                                    <input class="style-input-text" type="text" value="NO DATA YET."
                                           placeholder="NO DATA YET." disabled="disabled">
                                </li>
                            @endif
                            @if($userData->company_title)
                                <li>
                                    <input class="style-input-text" type="text" value="{{$userData->company_title}}"
                                           placeholder="Add company" disabled="disabled">
                                </li>
                            @endif
                            @if($userData->job_title)
                                <li>
                                    <input class="style-input-text" type="text" value="{{$userData->job_title}}"
                                           placeholder="Add job title / status" disabled="disabled">
                                </li>
                            @endif
                            @if($userData->university_title)
                                <li>
                                    <input class="style-input-text" type="text" value="{{$userData->university_title}}"
                                           placeholder="Add university" disabled="disabled">
                                </li>
                            @endif
                            @if($userData->certificate_title)
                                <li>
                                    <input class="style-input-text" type="text" value="{{$userData->certificate_title}}"
                                           placeholder="Add certificate" disabled="disabled">
                                </li>
                            @endif
                        @else
                            @if (!$userData->company_title && !$userData->job_title && !$userData->university_title && !$userData->certificate_title)
                                <li>
                                    <input class="style-input-text" type="text" value="NO DATA YET."
                                           placeholder="NO DATA YET." disabled="disabled">
                                </li>
                            @endif
                            @if($userData->company_title)
                                <li>
                                    <input class="style-input-text" type="text" value="{{$userData->company_title}}"
                                           placeholder="Add company" disabled="disabled">
                                </li>
                            @endif
                            @if($userData->job_title)
                                <li>
                                    <input class="style-input-text" type="text" value="{{$userData->job_title}}"
                                           placeholder="Add job title / status" disabled="disabled">
                                </li>
                            @endif
                            @if($userData->university_title)
                                <li>
                                    <input class="style-input-text" type="text" value="{{$userData->university_title}}"
                                           placeholder="Add university" disabled="disabled">
                                </li>
                            @endif
                            @if($userData->certificate_title)
                                <li>
                                    <input class="style-input-text" type="text" value="{{$userData->certificate_title}}"
                                           placeholder="Add certificate" disabled="disabled">
                                </li>
                            @endif
                        @endif

                    </ul>
                </div>
                @if ($mode == 'me')
                    @if($userData->impress)
                        <div class="cards user__card">
                            <h5 class="user__card_title">IMPRESSIVE BIO:</h5>
                            <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                            <textarea class="style-textarea border-violet" rows="4" cols="50" disabled="disabled"
                                      placeholder="Write something to impress your recruiters and future meetups!">{{$userData->impress}}</textarea>
                        </div>
                    @endif
                @else
                    @if($userData->impress)
                        <div class="cards user__card">
                            <h5 class="user__card_title">IMPRESSIVE BIO:</h5>
                            <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                            <textarea class="style-textarea border-violet" rows="4" cols="50" disabled="disabled"
                                  placeholder="Write something to impress your recruiters and future meetups!">{{$userData->impress}}</textarea>
                        </div>
                    @endif

                @endif

                @if($mode == 'me')
                    @if($userData->top_skills)
                        @php
                            $topSkills = explode("\n", trim($userData->top_skills));
                            array_map('trim', $topSkills);
                            if (!empty($topSkills) && count($topSkills) == 1 && isset($topSkills[0]) && ($topSkills[0] == "" || $topSkills[0] == " ")) {
                                $topSkills = null;
                            }
                        @endphp
                    @else
                        @php
                            $topSkills = [];
                        @endphp
                    @endif
                    @if(!empty($topSkills))
                        <div class="cards user__card">
                            <h5 class="user__card_title">Top Skills / Areas of Interest</h5>
                            <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                            <ul class="list-type-circle">
                                @foreach($topSkills as $skill)
                                    @if($skill)
                                        <li>
                                            <input class="style-input-text" type="text" value="{{$skill}}"
                                                   placeholder="Add skill / interest" disabled="disabled">
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @else
                    @if($userData->top_skills)
                        @php
                            $topSkills = explode("\n", trim($userData->top_skills));
                            array_map('trim', $topSkills);
                            if (!empty($topSkills) && count($topSkills) == 1 && isset($topSkills[0]) && ($topSkills[0] == "" || $topSkills[0] == " ")) {
                                $topSkills = null;
                            }
                        @endphp
                    @else
                        @php
                            $topSkills = [];
                        @endphp
                    @endif
                    @if(!empty($topSkills))
                        <div class="cards user__card">
                            <h5 class="user__card_title">Top Skills / Areas of Interest</h5>
                            <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                            <ul class="list-type-circle">
                                @foreach($topSkills as $skill)
                                    @if($skill)
                                        <li>
                                            <input class="style-input-text" type="text" value="{{$skill}}"
                                                   placeholder="Add skill / interest" disabled="disabled">
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif

                @if($mode == 'me')
                    @if($userData->soft_skills)
                        @php
                            $softSkills = explode("\n", trim($userData->soft_skills));
                            array_map('trim', $softSkills);
                            if (!empty($softSkills) && count($softSkills) == 1 && isset($softSkills[0]) && ($softSkills[0] == "" || $softSkills[0] == " ")) {
                                $softSkills = null;
                            }
                        @endphp
                    @else
                        @php
                            $softSkills = [];
                        @endphp
                    @endif
                    @if(!empty($softSkills))
                        <div class="cards user__card">
                            <h5 class="user__card_title">Soft Skills</h5>
                            <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                            <ul class="list-type-circle">
                                @foreach($softSkills as $skill)
                                    @if($skill)
                                        <li>
                                            <input class="style-input-text" type="text" value="{{$skill}}"
                                                   placeholder="Add soft skill" disabled="disabled">
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @else
                    @if($userData->soft_skills)
                        @php
                            $softSkills = explode("\n", trim($userData->soft_skills));
                            array_map('trim', $softSkills);
                            if (!empty($softSkills) && count($softSkills) == 1 && isset($softSkills[0]) && ($softSkills[0] == "" || $softSkills[0] == " ")) {
                                $softSkills = null;
                            }
                        @endphp
                    @else
                        @php
                            $softSkills = [];
                        @endphp
                    @endif
                    @if(!empty($softSkills))
                        <div class="cards user__card">
                            <h5 class="user__card_title">Soft Skills</h5>
                            <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                            <ul class="list-type-circle">
                                @foreach($softSkills as $skill)
                                    @if($skill)
                                        <li>
                                            <input class="style-input-text" type="text" value="{{$skill}}"
                                                   placeholder="Add soft skill" disabled="disabled">
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif

                @if($mode == 'me')
                    @if($userData->educations->count())
                        <div class="cards user__card">
                            <h5 class="user__card_title">Education:</h5>
                            @foreach($userData->educations as $education)
                                <div class="user__card_info">
                                    <span class="user__card_icon">
                                        <img src="{{asset('img/icons/graduate-cap.svg')}}" alt=""/>
                                    </span>
                                    <div class="user__card_text">
                                        <div class="style-input-text style-input-text_15 height-auto">{{$education->title}}</div>
                                        <div class="style-input-text style-input-text_12 height-auto">{{$education->speciality}}</div>
                                    </div>
                                    @if($education->status == getenv('VERIFIED_STATUSES_VALIDATED'))
                                        <span class="user__validated">Validated <img src="{{asset('img/icons/checked.svg')}}" alt=""></span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($userData->certifications->count())
                        <div class="cards user__card">
                            <h5 class="user__card_title">Skill Certifications:</h5>
                            @foreach($userData->certifications as $certificate)
                                <div class="user__card_info">
                                    <span class="user__card_icon">
                                        <img src="{{asset('img/icons/guarantee-certificate.svg')}}" alt=""/>
                                    </span>
                                    <div class="user__card_text">
                                        <div class="style-input-text style-input-text_15 height-auto">{{$certificate->title}}</div>
                                    </div>
                                    @if($certificate->status == getenv('VERIFIED_STATUSES_VALIDATED'))
                                        <span class="user__validated">Validated <img src="{{asset('img/icons/checked.svg')}}" alt=""></span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    @if($userData->educations->count())
                        <div class="cards user__card">
                            <h5 class="user__card_title">Education:</h5>
                            @foreach($userData->educations as $education)
                                <div class="user__card_info">
                                    <span class="user__card_icon">
                                        <img src="{{asset('img/icons/graduate-cap.svg')}}" alt=""/>
                                    </span>
                                    <div class="user__card_text">
                                        <div class="style-input-text style-input-text_15 height-auto">{{$education->title}}</div>
                                        <div class="style-input-text style-input-text_12 height-auto">{{$education->speciality}}</div>
                                    </div>
                                    @if($education->status == getenv('VERIFIED_STATUSES_VALIDATED'))
                                        <span class="user__validated">Validated <img src="{{asset('img/icons/checked.svg')}}" alt=""></span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($userData->certifications->count())
                        <div class="cards user__card">
                            <h5 class="user__card_title">Skill Certifications:</h5>
                            @foreach($userData->certifications as $certificate)
                                <div class="user__card_info">
                                    <span class="user__card_icon">
                                        <img src="{{asset('img/icons/guarantee-certificate.svg')}}" alt=""/>
                                    </span>
                                    <div class="user__card_text">
                                        <div class="style-input-text style-input-text_15 height-auto">{{$certificate->title}}</div>
                                    </div>
                                    @if($certificate->status == getenv('VERIFIED_STATUSES_VALIDATED'))
                                        <span class="user__validated">Validated <img src="{{asset('img/icons/checked.svg')}}" alt=""></span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('popups')
    @if (app('request')->has('show_pending_popup') && !$userData->is_verified)
        <button class="btn btn-violet hide open-pop-up" id="showPendingPopup" data-target="#pendingPopup">
            Pending popup
        </button>
        <div class="modal-window show" id="pendingPopup" style="display: block;">
            <div class="modal-window__content">
                <div class="modal-window__body text-center">
                    <img src="{{asset('img/icons/smile.svg')}}" alt="like" class="modal-window__img-top">
                    <h3 class="title mb-34">Your validation is in progress.</h3>
                    <p>Once your profile is approved, you will have access to all our features. It’s a perfect opportunity to meditate, water your plants or share IMPRESSO with your friends!</p>
                    <button type="button" class="btn btn-violet close-modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if (app('request')->has('show_profile_setup_profile'))
        <button class="btn btn-violet hide open-pop-up" id="showFeedsLetStartImpressing" data-target="#letStartImpressing">
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
                    <a href="{{url('/profile/edit')}}" type="button" class="btn btn-violet">
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
