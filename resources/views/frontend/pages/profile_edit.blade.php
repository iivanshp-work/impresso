@extends("frontend.layouts.app")

@section("htmlheader_title")
    Edit Profile
@endsection

@section("main-content")

    <div class="main">
        <header class="header">
            <h4 class="header-title">Edit Profile</h4>
            <span class="header__icon-right">
                <a href="#"><img src="{{asset('img/icons/settings.svg')}}" alt="" /></a>
                <img src="{{asset('img/icons/bell.svg')}}" alt="" />
            </span>
        </header>
        <main>
            <form id="edit_profile_form" action="{{url('/profile/edit')}}" method="post" data-edit-profile-form="">
                <div class="user edit-profile">
                    <div class="user__header">
                        <div class="user__avatar">
                            <input type="hidden" name="photo" data-photo-hidden value="{{$userData->photo}}">
                            <input type="file" class="hide" data-edit-profile-send-photo-hidden="" data-image-id="photo">
                            @if($userData->photo)
                                <img data-edit-profile-src="" src="{{url('/files/' . $userData->photo . '?s=200')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
                            @else
                                <img data-edit-profile-src="" src="{{asset('img/icons/user-icon.svg')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
                            @endif
                            <a href="#" data-edit-profile-send-photo="" class="edit-photo">edit photo</a>
                        </div>
                        <span class="edit-icon" id="edit-profile">
                            <a href="#" data-edit-profile-send-photo="" class="edit-photo"><img src="{{asset('img/icons/edit.svg')}}" alt="" /></a>
                        </span>
                        @if($userData->is_verified)
                            <span class="user__checked">
                                <img src="{{asset('img/icons/icon-checked.svg')}}" alt="" />
                            </span>
                        @endif
                    </div>
                    <input class="user__name style-input-text" autocomplete="off" type="text" name="name" value="@if($userData->name){{$userData->name}}@endif" placeholder="Add name">
                    <div class="job-title">
                        <input class="style-input-text style-input-text_right" autocomplete="off" type="text" name="job_title_top" value="@if($userData->job_title){{$userData->job_title}}@endif" placeholder="Add job title ">
                        <span>at</span>
                        <input class="style-input-text" autocomplete="off" type="text" name="company_title_top" value="@if($userData->company_title){{$userData->company_title}}@endif" placeholder="Add company">
                    </div>

                    <div class="user__info">
                        <p>
                            <img src="{{asset('img/icons/maps-and-flags.png')}}" alt="" />
                            @if($userData->location_title){{$userData->location_title}}@else{{'Phone location'}}@endif
                        </p>
                        <p>
                            <img src="{{asset('img/icons/multiple-users-silhouette.png')}}" alt="" />
                            @if($userData->meetup_count){{$userData->meetup_count}}@else{{'0'}}@endif Meetups
                        </p>
                    </div>
                    <div class="cards user__card">
                        <h5 class="user__card_title">Basic Information</h5>
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                        <ul class="list-type-circle">
                            <li>
                                <input class="style-input-text" type="text" value="@if($userData->company_title){{$userData->company_title}}@else{{''}}@endif"
                                       name="company_title" autocomplete="off" placeholder="Add company">
                            </li>
                            <li>
                                <input class="style-input-text" type="text" value="@if($userData->job_title){{$userData->job_title}}@else{{''}}@endif"
                                        name="job_title" autocomplete="off" placeholder="Add job title / status">
                            </li>
                            <li>
                                <input class="style-input-text" type="text" value="@if($userData->university_title){{$userData->university_title}}@else{{''}}@endif"
                                       name="university_title" autocomplete="off" placeholder="Add university">
                            </li>
                            <li>
                                <input class="style-input-text" type="text" value="@if($userData->certificate_title){{$userData->certificate_title}}@else{{''}}@endif"
                                       name="certificate_title" autocomplete="off" placeholder="Add certificate">
                            </li>
                        </ul>
                    </div>

                    <div class="cards user__card">
                        <h5 class="user__card_title">IMPRESSIVE BIO:</h5>
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                        <textarea class="style-textarea border-violet" rows="4" cols="50"
                                  name="impress" autocomplete="off" placeholder="Write something to impress your recruiters and future meetups!">{{$userData->impress}}</textarea>
                    </div>



                    @if($userData->top_skills)
                        @php
                            $topSkills = explode("\n", $userData->top_skills);
                            array_map('trim', $topSkills);
                            $topSkillIteration = 0;
                        @endphp
                    @else
                        @php
                            $topSkills = [];
                            $topSkillIteration = 0;
                        @endphp
                    @endif

                    <div class="cards user__card">
                        <h5 class="user__card_title">Top Skills / Areas of Interest</h5>
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                        <ul class="list-type-circle">
                            @if(!empty($topSkills))
                                @foreach($topSkills as $skill)
                                    @if($skill)
                                        <li>
                                            <input class="style-input-text" type="text" value="{{$skill}}"
                                                   name="top_skills[{{$topSkillIteration}}]" autocomplete="off" placeholder="Add skill / interest">
                                        </li>
                                        @php
                                            $topSkillIteration++;
                                        @endphp
                                    @endif
                                @endforeach
                            @endif
                            @if ($topSkillIteration < 3)
                                @while($topSkillIteration < 3)
                                    <li>
                                        <input class="style-input-text" type="text" value=""
                                               name="top_skills[{{$topSkillIteration}}]" autocomplete="off" placeholder="Add skill / interest">
                                    </li>
                                    @php
                                        $topSkillIteration++;
                                    @endphp
                                @endwhile
                            @endif
                        </ul>
                    </div>



                    @if($userData->soft_skills)
                        @php
                            $softSkills = explode("\n", $userData->soft_skills);
                            array_map('trim', $softSkills);
                            $softSkillIteration = 0;
                        @endphp
                    @else
                        @php
                            $softSkills = [];
                            $softSkillIteration = 0;
                        @endphp
                    @endif

                    <div class="cards user__card">
                        <h5 class="user__card_title">Soft Skills</h5>
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                        <ul class="list-type-circle">
                            @if(!empty($softSkills))
                                @foreach($softSkills as $skill)
                                    @if($skill)
                                        <li>
                                            <input class="style-input-text" type="text" value="{{$skill}}"
                                                   name="soft_skills[{{$softSkillIteration}}]" autocomplete="off" placeholder="Add skill / interest">
                                        </li>
                                        @php
                                            $softSkillIteration++;
                                        @endphp
                                    @endif
                                @endforeach
                            @endif
                            @if ($softSkillIteration < 3)
                                @while($softSkillIteration < 3)
                                    <li>
                                        <input class="style-input-text" type="text" value=""
                                               name="soft_skills[{{$softSkillIteration}}]" autocomplete="off" placeholder="Add soft skill">
                                    </li>
                                    @php
                                        $softSkillIteration++;
                                    @endphp
                                @endwhile
                            @endif
                        </ul>
                    </div>

                    <div class="cards user__card" id="educations" data-education-wrapper="">
                        <h5 class="user__card_title">Education:</h5>
                        <span class="edit-info" data-add-new-education=""><img src="{{asset('img/icons/plus.svg')}}" alt="" /></span>
                        <div data-education-template="" class="hide">
                            <div data-education-item="" class="user__card_info">
                                <span class="user__card_icon">
                                    <img src="{{asset('img/icons/graduate-cap.svg')}}" alt="" />
                                </span>
                                <div class="user__card_text">
                                    <input data-id-field="" type="hidden" name="education[%KEY%][id]" value="" >
                                    <input data-title-field="" class="style-input-text style-input-text_15" type="text"
                                           name="education[%KEY%][title]" value="" placeholder="School Name">
                                    <input data-speciality-field="" class="style-input-text style-input-text_12" type="text"
                                           name="education[%KEY%][speciality]" value="" placeholder="Speciality / Domain">
                                </div>
                                <div class="user__card_group-btn edit-group-btn">
                                    <button type="button" data-remove-item="" data-id="" class="btn btn-border">Remove</button>
                                    <button type="button" data-request-validation-item="" data-id="" class="btn btn-violet">
                                        Request Validation
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if($userData->educations->count())
                            @foreach($userData->educations as $education)
                                <div class="user__card_info" data-education-item="">
                                        <span class="user__card_icon">
                                            <img src="{{asset('img/icons/graduate-cap.svg')}}" alt="" />
                                        </span>
                                    <div class="user__card_text">
                                        <input data-id-field="" type="hidden" name="education[{{$education->id}}][id]" value="{{$education->id}}">
                                        <input data-title-field="" class="style-input-text style-input-text_15" type="text"
                                               name="education[{{$education->id}}][title]" value="{{$education->title}}" placeholder="School Name">
                                        <input data-speciality-field="" class="style-input-text style-input-text_12" type="text"
                                               name="education[{{$education->id}}][speciality]" value="{{$education->speciality}}" placeholder="Speciality / Domain">
                                    </div>
                                    <div class="user__card_group-btn edit-group-btn">
                                        <button type="button" data-remove-item="" data-id="{{$education->id}}" class="btn btn-border">Remove</button>
                                        <button type="button" data-request-validation-item="" data-id="{{$education->id}}" class="btn btn-violet">
                                            Request Validation
                                        </button>
                                    </div>
                                    @if($education->status == getenv('VERIFIED_STATUSES_VALIDATED'))
                                        <span class="user__validated">Validated <img src="{{asset('img/icons/checked.svg')}}" alt=""></span>
                                    @endif
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="cards user__card" id="certifications">
                        <h5 class="user__card_title">Skill Certifications:</h5>
                        <span class="edit-info" data-add-new-certificate=""><img src="{{asset('img/icons/plus.svg')}}" alt="" /></span>

                        <div data-certificate-template="" class="user__card_info hide">
                            <span class="user__card_icon">
                                <img src="{{asset('img/icons/guarantee-certificate.svg')}}" alt="" />
                            </span>
                            <div class="user__card_text">
                                <input class="style-input-text style-input-text_15" type="text"
                                       name="cartificate[%KEY%][title]" value="" placeholder="Certificate Name">
                            </div>
                            <div class="user__card_group-btn edit-group-btn">
                                <button class="btn btn-border">Remove</button>
                                <button class="btn btn-violet">
                                    Request Validation
                                </button>
                            </div>
                            {{--<span class="user__validated">Validated <img src="{{asset('img/icons/checked.svg')}}" alt=""></span>--}}
                        </div>
                    </div>

                    <button type="submit" id="save" class="btn btn-violet btn-save">Save</button>
                </div>
            </form>
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
