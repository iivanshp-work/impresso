@extends("frontend.layouts.app")

@section("htmlheader_title")
    Edit Profile
@endsection

@section("main-content")

    <div class="main">
        <header class="header">
            <h4 class="header-title">Edit Profile</h4>
            <span class="header__icon-right">
                <a href="{{url('/settings')}}"><img src="{{asset('img/icons/settings.svg')}}" alt="" /></a>
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
                                <img data-edit-profile-src="" src="{{asset('img/icons/icon-user.png')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
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
                                <span class="user__validated hide">Pending</span>
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
                                        <input data-title-field="" class="style-input-text style-input-text_15" type="text" @if($education->status != getenv('VERIFIED_STATUSES_NEW')) disabled="disabled" @endif
                                               name="education[{{$education->id}}][title]" value="{{$education->title}}" placeholder="School Name">
                                        <input data-speciality-field="" class="style-input-text style-input-text_12" type="text" @if($education->status != getenv('VERIFIED_STATUSES_NEW')) disabled="disabled" @endif
                                               name="education[{{$education->id}}][speciality]" value="{{$education->speciality}}" placeholder="Speciality / Domain">
                                    </div>
                                    <div class="user__card_group-btn edit-group-btn">
                                        <button type="button" data-remove-item="" data-id="{{$education->id}}" class="btn btn-border">Remove</button>
                                        @if($education->status == getenv('VERIFIED_STATUSES_NEW'))
                                            <button type="button" data-request-validation-item="" data-id="{{$education->id}}" class="btn btn-violet">
                                                Request Validation
                                            </button>
                                        @endif
                                    </div>
                                    @if($education->status == getenv('VERIFIED_STATUSES_VALIDATED'))
                                        <span class="user__validated">Validated <img src="{{asset('img/icons/checked.svg')}}" alt=""></span>
                                    @elseif($education->status == getenv('VERIFIED_STATUSES_REQUEST_VERIFICATION'))
                                        <span class="user__validated">Pending</span>
                                    @elseif($education->status == getenv('VERIFIED_STATUSES_FAILED'))
                                        <span class="user__validated">Failed</span>
                                    @else
                                        <span class="user__validated hide">Pending</span>
                                    @endif
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="cards user__card" id="certifications" data-certificate-wrapper="">
                        <h5 class="user__card_title">Skill Certifications:</h5>
                        <span class="edit-info" data-add-new-certificate=""><img src="{{asset('img/icons/plus.svg')}}" alt="" /></span>
                        <div data-certificate-template="" class="hide">
                            <div data-certificate-item="" class="user__card_info">
                                <span class="user__card_icon">
                                    <img src="{{asset('img/icons/guarantee-certificate.svg')}}" alt="" />
                                </span>
                                <div class="user__card_text">
                                    <input data-id-field="" type="hidden" name="certificate[%KEY%][id]" value="" >
                                    <input data-title-field="" class="style-input-text style-input-text_15" type="text"
                                           name="certificate[%KEY%][title]" value="" placeholder="Certificate Name">
                                </div>
                                <div class="user__card_group-btn edit-group-btn">
                                    <button type="button" data-remove-item="" data-id="" class="btn btn-border">Remove</button>
                                    <button type="button" data-request-validation-item="" data-id="" class="btn btn-violet">
                                        Request Validation
                                    </button>
                                </div>
                                <span class="user__validated hide">Pending</span>
                            </div>
                        </div>
                        @if($userData->certifications->count())
                            @foreach($userData->certifications as $certificate)
                                <div class="user__card_info" data-certificate-item="">
                                        <span class="user__card_icon">
                                            <img src="{{asset('img/icons/guarantee-certificate.svg')}}" alt="" />
                                        </span>
                                    <div class="user__card_text">
                                        <input data-id-field="" type="hidden" name="certificate[{{$certificate->id}}][id]" value="{{$certificate->id}}">
                                        <input data-title-field="" class="style-input-text style-input-text_15" type="text" @if($certificate->status != getenv('VERIFIED_STATUSES_NEW')) disabled="disabled" @endif
                                               name="certificate[{{$certificate->id}}][title]" value="{{$certificate->title}}" placeholder="Certificate Name" >
                                    </div>
                                    <div class="user__card_group-btn edit-group-btn">
                                        <button type="button" data-remove-item="" data-id="{{$certificate->id}}" class="btn btn-border">Remove</button>
                                        @if($certificate->status == getenv('VERIFIED_STATUSES_NEW'))
                                            <button type="button" data-request-validation-item="" data-id="{{$certificate->id}}" class="btn btn-violet">
                                                Request Validation
                                            </button>
                                        @endif
                                    </div>
                                    @if($certificate->status == getenv('VERIFIED_STATUSES_VALIDATED'))
                                        <span class="user__validated">Validated <img src="{{asset('img/icons/checked.svg')}}" alt=""></span>
                                    @elseif($certificate->status == getenv('VERIFIED_STATUSES_REQUEST_VERIFICATION'))
                                        <span class="user__validated">Pending</span>
                                    @elseif($certificate->status == getenv('VERIFIED_STATUSES_FAILED'))
                                        <span class="user__validated">Failed</span>
                                    @else
                                        <span class="user__validated hide">Pending</span>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <button type="submit" id="save" class="btn btn-violet btn-save">Save</button>
                </div>
            </form>
        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('popups')

    <button btn-upload-popup="" class="hide btn btn-violet open-pop-up" data-target="#upload">Upload</button>
    <button btn-upload-remove-popup="" class="hide btn btn-violet open-pop-up" data-target="#uploadFile2">Upload file 2</button>
    <button btn-validate-popup="" class="hide btn btn-violet open-pop-up" data-target="#validate">Validate</button>
    <button btn-validate-success-popup="" class="hide btn btn-violet open-pop-up" data-target="#validateSuccess">Validate success</button>
    <button btn-validate-not_xims-popup="" class="hide btn btn-violet open-pop-up" data-target="#notEnoughMinerals">Not enough minerals</button>

    <div class="modal-window" id="upload" data-upload-popup="">
        <div class="modal-window__content">
            <form id="edit_profile_upload_attach_form" action="" method="post">
                <div class="modal-window__body upload-modal text-center">
                    <p class="upload-modal__title">
                        Add URL certificate
                    </p>
                    <input name="url" type="text" class="gray-input" placeholder="Enter URL" />
                    <input name="files" type="hidden" data-files-value="" value=""/>
                    <span class="or">OR</span>
                    <input type="file" name="files_hidden" class="hide" multiple="multiple" data-edit-profile-send-popup-files-hidden="">
                    <a href="#" class="btn btn-border btn-download" data-edit-profile-send-popup-files="">Upload document</a>
                    <span class="text-color-gray default_title">Accepted files: PDF, JPG, PNG, DOC.</span>
                    <span class="text-color-gray hide selected_files_title" ><span class="files_text"></span><span data-remove-selected-files="" class="remove_selected_files"><img src="{{asset('img/icons/plus.svg')}}" alt="" /></span></span>
                    <button type="button" class="btn btn-violet" data-profile-edit-upload-btn="">
                        Continue
                    </button>
                    <button type="button" class="btn btn-border close-modal">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-window" id="uploadFile2" data-upload-remove-popup="">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <p>
                    You are about to remove this file.
                </p>
                <p class="my-10">Are you sure?</p>
                <button type="button" class="btn btn-violet" data-profile-edit-upload-remove-btn="">
                    Continue
                </button>
                <button type="button" class="btn btn-border close-modal" data-profile-edit-upload-remove-btn-cancel="">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <div class="modal-window" id="validate" data-validate-popup="">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <p>
                    A Certificate validation will cost you {{LAConfigs::getByKey('validation_value')}} XIMs.
                </p>
                <p>Do you want to proceed?</p>
                <button type="button" class="btn btn-violet" data-profile-edit-validate-btn="">
                    Continue
                </button>
                <button type="button" class="btn btn-border close-modal" data-profile-edit-validate-btn-cancel="">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <div class="modal-window" id="validateSuccess" data-validate-success-popup="">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <img src="{{asset('img/icons/like.png')}}" alt="like" class="modal-window__img-top" />
                <h3 class="title mb-34">Success!</h3>
                <p>Please be patient, as the validation process can take a few hours, up to a few days.</p>
                <p>Note: Your XIM balance will take a while to refresh.</p>
                <button type="button" class="btn btn-violet close-modal">
                    Close
                </button>
            </div>
        </div>
    </div>

    <div class="modal-window" id="notEnoughMinerals" data-validate-not_xims-popup="">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <h3 class="mb-34">Uh-oh!</h3>
                <p>
                    Looks like you don’t have enough XIMs.
                </p>
                <p>A Certificate validation costs {{LAConfigs::getByKey('validation_value')}} XIMs.</p>
                <a href="{{url('/settings/credits')}}" type="button" class="btn btn-violet">
                    Buy XIMs
                </a>
                <button type="button" class="btn btn-border close-modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>

@endpush

@push('styles')
@endpush

@push('scripts')
@endpush
