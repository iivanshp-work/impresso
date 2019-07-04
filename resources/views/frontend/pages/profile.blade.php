@extends("frontend.layouts.app")

@section("htmlheader_title")
    Profile
@endsection

@section("main-content")

    <div class="main">
        <header class="header">
            <h4 class="header-title">Profile</h4>
            <span class="header__icon-right">
                <a href="#"><img src="img/icons/settings.svg" alt="" /></a>
                <img src="img/icons/bell.svg" alt="" />
            </span>
        </header>
        <main>
            <div class="user">
                <div class="user__header">
                    <div class="user__avatar">
                        <img src="img/avatars/avatar-big.png" alt="" />
                        <a href="#" download class="edit-photo">edit photo</a>
                    </div>
                    <span class="edit-icon" id="edit-profile">
                        <img src="img/icons/edit.svg" alt="" />
                    </span>
                    <span class="user__checked">
                        <img src="img/icons/icon-checked.svg" alt="" />
                    </span>
                </div>
                <h4 class="user__name">Lilly Barton</h4>
                <div class="job-title">
                    <input class="style-input-text style-input-text_right" type="text" value="Project Manager"
                           placeholder="Job title ">
                    <span>at</span>
                    <input class="style-input-text" type="text" value="Surfs Up Chill" placeholder="Company">
                </div>
                <div class="user__info">
                    <p>
                        <img src="img/icons/maps-and-flags.png" alt="" />
                        Phone location
                    </p>
                    <p>
                        <img src="img/icons/multiple-users-silhouette.png" alt="" />
                        0 Meetups
                    </p>
                </div>
                <div class="cards user__card">
                    <h5 class="user__card_title">Basic Information</h5>
                    <span class="edit-info"><img src="img/icons/pen.svg" alt="" /></span>
                    <ul class="list-type-circle">
                        <li>
                            <input class="style-input-text" type="text" value="Project Manager"
                                   placeholder="Add company" disabled>
                        </li>
                        <li>
                            <input class="style-input-text" type="text" value="Surfs Up Chill"
                                   placeholder="Add university" disabled>
                        </li>
                        <li>
                            <input class="style-input-text" type="text" value="University of Copenhagen"
                                   placeholder="Add job title / status" disabled>
                        </li>
                        <li>
                            <input class="style-input-text" type="text" value="Bachelor of Science (Physiotherapy)"
                                   placeholder="Add certificate" disabled>
                        </li>
                    </ul>
                </div>
                <div class="cards user__card">
                    <h5 class="user__card_title">IMPRESSIVE BIO:</h5>
                    <span class="edit-info"><img src="img/icons/pen.svg" alt="" /></span>
                    <textarea class="style-textarea border-violet" rows="4" cols="50" disabled
                              placeholder="Write something to impress your recruiters and future meetups!">I am developing a mobile app to help students find free food on campus in partnerships with organizations to increase traffic at their events.</textarea>
                </div>
                <div class="cards user__card">
                    <h5 class="user__card_title">Top Skills / Areas of Interest</h5>
                    <span class="edit-info"><img src="img/icons/pen.svg" alt="" /></span>
                    <ul class="list-type-circle">
                        <li>
                            <input class="style-input-text" type="text" value="Investment"
                                   placeholder="Add skill / interest" disabled>
                        </li>
                        <li>
                            <input class="style-input-text" type="text" value="Photography"
                                   placeholder="Add skill / interest" disabled>
                        </li>
                        <li>
                            <input class="style-input-text" type="text" value="Blockchain"
                                   placeholder="Add skill / interest" disabled>
                        </li>
                    </ul>
                </div>
                <div class="cards user__card">
                    <h5 class="user__card_title">Soft Skills</h5>
                    <span class="edit-info"><img src="img/icons/pen.svg" alt="" /></span>
                    <ul class="list-type-circle">
                        <li>
                            <input class="style-input-text" type="text" value="Time Management"
                                   placeholder="Add soft skill" disabled>
                        </li>
                        <li>
                            <input class="style-input-text" type="text" value="Teamwork" placeholder="Add soft skill"
                                   disabled>
                        </li>
                        <li><input class="style-input-text" type="text" value="Creativity" placeholder="Add soft skill"
                                   disabled>
                        </li>
                    </ul>
                </div>
                <div class="cards user__card">
                    <h5 class="user__card_title">Education:</h5>
                    <span class="edit-info"><img src="img/icons/plus.svg" alt="" /></span>
                    <div class="user__card_info">
                        <span class="user__card_icon">
                            <img src="img/icons/graduate-cap.svg" alt="" />
                        </span>
                        <div class="user__card_text">
                            <input class="style-input-text style-input-text_15" type="text"
                                   value="University of Copenhagen" placeholder="School Name" disabled>
                            <input class="style-input-text style-input-text_12" type="text"
                                   value="Applied Modern Languages" placeholder="Speciality / Domain" disabled>
                        </div>
                        <div class="user__card_group-btn edit-group-btn">
                            <button class="btn btn-border">Remove</button>
                            <button class="btn btn-violet">
                                Request Validation
                            </button>
                        </div>
                    </div>
                </div>
                <div class="cards user__card">
                    <h5 class="user__card_title">Skill Certifications:</h5>
                    <span class="edit-info"><img src="img/icons/plus.svg" alt="" /></span>
                    <div class="user__card_info">
                        <span class="user__card_icon">
                            <img src="img/icons/guarantee-certificate.svg" alt="" />
                        </span>
                        <div class="user__card_text">
                            <input class="style-input-text style-input-text_15" type="text"
                                   value="Blockchain Council Certificate" placeholder="Certificate Name" disabled>
                        </div>
                        <div class="user__card_group-btn edit-group-btn">
                            <button class="btn btn-border">Remove</button>
                            <button class="btn btn-violet">
                                Request Validation
                            </button>
                        </div>
                        <span class="user__validated">Validated <img src="img/icons/checked.svg" alt=""></span>
                    </div>
                </div>
                <button type="button" id="save" class="btn btn-violet btn-save">Save</button>
            </div>
        </main>
        @include('frontend.layouts.partials.footer_fixed')
    </div>
@endsection

@push('popups')

    @if (app('request')->has('show_profile_setup_profile'))
        <button class="btn btn-violet open-pop-up" id="showFeedsLetStartImpressing" data-target="#letStartImpressing">
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
                    <a href="{{url('/profile')}}" type="button" class="btn btn-violet">
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
