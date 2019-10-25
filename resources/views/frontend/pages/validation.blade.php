@extends("frontend.layouts.app")

@section("htmlheader_title")
    Validation
@endsection

@section("main-content")
    <main class="main">
        <form id="validationForm" class="validation text-center">
            <div id="step1" class="validation__step validation__step_first">
                <section class="wizard">
                    <div class="wizard__body">
                        <header class="header">
                            <h4>Profile Validation</h4>
                            {{--<span class="header__icon-left" data-validation-step="step1">
                                <img src="{{ asset('img/icons/arrow-back.svg') }}" alt="arrow-back"/>
                            </span>--}}
                        </header>
                        <h3 class="wizard__subtitle">The Wizard</h3>
                        <div class="wizard__image">
                            <img src="{{ asset('img/wizard-img.png') }}" alt="wizard">
                        </div>
                        <h2 class="wizard__title">YOU SHALL NOT PASS!</h2>
                        <p class="wizard__text">Unless you take a selfie with your valid identity card.</p>
                    </div>
                    <div class="wizard__footer">
                        <a href="#" class="wizard__link open-pop-up" data-target="#validationMyProfile">Why do I need to do this?</a>
                        <a href="#" class="btn btn-violet" data-validation-step="step2">Start Now</a>
                    </div>
                </section>
            </div>
            <div id="step2" class="validation__step">
                <header class="header">
                    <h4>Profile Validation</h4>
                    <span class="header__icon-left" data-validation-step-to-first="" data-validation-step="step1">
                        <img src="{{ asset('img/icons/arrow-back.svg') }}" alt="arrow-back"/>
                    </span>
                </header>
                <p>Step 1 / 2</p>
                <div class="validation__icon">
                    <img src="{{ asset('img/validate-image-1.png') }}" alt=""/>
                </div>

                <p class="validation__text-big">Take a clear photo of your <strong>ID</strong></p>
                <p>We Accept Only:<br />
                    Driver’s license or any institutional government issued ID <strong>with photo</strong>.</p>
                <div class="validation__group-btn">
                    <input type="file"  capture="capture" accept="image/*" class="hide" data-validation-send-file-hidden="" data-image-id="photo_id">
                    <button type="button" class="btn btn-violet" data-validation-send-file="">
                        Take ID photo
                    </button>
                </div>
            </div>
            <div id="step3" class="validation__step">
                <header class="header">
                    <h4>Profile Validation</h4>
                    <span class="header__icon-left" data-validation-step="step2">
                        <img src="{{ asset('img/icons/arrow-back.svg') }}" alt="arrow-back"/>
                    </span>
                </header>
                <p>Step 1 / 2</p>
                <div class="validation__picture">
                    <img data-validation-photo_id-src="" src="{{ asset('img/image-1.png') }}" alt=""/>
                </div>
                <p class="validation__text-big">Take a clear photo of your <strong>ID</strong></p>
                <p>We Accept Only:<br />
                    Driver’s license or any institutional government issued ID <strong>with photo</strong>.</p>
                <div class="validation__group-btn">
                    <button type="button" class="btn btn-violet" data-validation-step="step4">
                        Save
                    </button>
                    <input type="file" capture="capture" accept="image/*" class="hide" data-validation-send-file-hidden="" data-image-id="photo_id">
                    <button type="button" class="btn btn-border" data-validation-send-file="">
                        Retake
                    </button>
                </div>
            </div>
            <div id="step4" class="validation__step">
                <header class="header">
                    <h4>Profile Validation</h4>
                    <span class="header__icon-left" data-validation-step="step3">
                        <img src="{{ asset('img/icons/arrow-back.svg') }}" alt="arrow-back"/>
                    </span>
                </header>
                <p>Step 2 / 2</p>
                <div class="validation__icon">
                    <img src="{{ asset('img/validate-image-2.png') }}" alt=""/>
                </div>
                <p class="validation__text-big">Take a selfie</p>
                <p>This will not be used as your profile photo and will not be visible on the App.</p>
                <div class="validation__group-btn">
                    <input type="file"  capture="capture" accept="image/*" class="hide" data-validation-send-file-hidden="" data-image-id="photo_selfie">
                    <button type="button" class="btn btn-violet" data-validation-send-file="">
                        Take a photo
                    </button>
                </div>
            </div>
            <div class="hide" data-validation-step="step5"></div>
            <div id="step5" class="validation__step">
                <header class="header">
                    <h4>Profile Validation</h4>
                    <span class="header__icon-left" data-validation-step="step4">
                        <img src="{{ asset('img/icons/arrow-back.svg') }}" alt="arrow-back"/>
                    </span>
                </header>
                <p>Step 2 / 2</p>
                <div class="validation__picture">
                    <img data-validation-photo_selfie-src=""  src="{{ asset('img/image-2.png') }}" alt=""/>
                </div>
                <p class="validation__text-big">Take a selfie</p>
                <p>This will not be used as your profile photo and will not be visible on the App.</p>
                <div class="validation__group-btn">
                    <button type="button" class="btn btn-violet" data-validation-check="">
                        Save
                    </button>
                    <input type="file"  capture="capture" accept="image/*" class="hide" data-validation-send-file-hidden="" data-image-id="photo_selfie">
                    <button type="button" class="btn btn-border" data-validation-send-file="">
                        Retake
                    </button>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('popups')
    {{--
    <button class="hide open-pop-up" id="clickThankYou" data-target="#thankYou">success validation</button>
    <div class="modal-window" id="thankYou">
        <div class="modal-window__content">
            <div class="modal-window__body validation-modal text-center">
                <h3 class="title mb-34">Thank you!</h3>
                <p>
                    We are now processing the information. Your validation status will be available shortly.
                </p>
                <a href="{{url(getenv('BASE_LOGEDIN_PAGE') . '?show_profile_setup_profile=1')}}" type="button" class="btn btn-violet">
                    Continue
                </a>
            </div>
        </div>
    </div>
    --}}
    <button class="btn btn-violet hide open-pop-up" id="showPendingPopup" data-target="#pendingPopup">
        Pending popup
    </button>
    <div class="modal-window" id="pendingPopup">
        <div class="modal-window__content">
            <div class="modal-window__body text-center">
                <img src="{{asset('img/icons/smile.svg')}}" alt="like" class="modal-window__img-top">
                <h3 class="title mb-34">Your validation is in progress.</h3>
                <<p>Please check your Inbox (Spam/Junk) for your SignUp Confirmation.</p>
                <a href="{{url(getenv('BASE_LOGEDIN_PAGE') . '?show_profile_setup_profile=1')}}" type="button" class="btn btn-violet">
                    Close
                </a>
            </div>
        </div>
    </div>

    <div class="modal-window" id="validationMyProfile">
        <div class="modal-window__content">
            <div class="modal-window__body validation-modal text-center">
                <h3 class="title mb-34">
                    Why validate?
                </h3>
                <p>
                    IMPRESSO is all about meeting face to face with other Professionals for your business and career growth.
                </p>
                <p>
                    Only validated Professionals will be able to use the App.  Your personal data will not be shared with other users.
                </p>
                <button type="button" class="btn btn-border close-modal">
                    Got it!
                </button>
            </div>
        </div>
    </div>

    @if($user->fail_validation)
        <button class="btn btn-violet hide open-pop-up" data-target="#validationFail">Validation Fail</button>
        <div class="modal-window show" id="validationFail" style="display: block">
            <div class="modal-window__content">
                <div class="modal-window__body text-center">
                    <img src="{{asset('img/icons/smiley-sad.svg')}}" alt="">
                    <h5 class="modal-window__subtitle">Uh-Oh! <br />Looks like a validation error.<br /> Let’s try again!
                    </h5>
                    <p>Getting validated is also important for other users.</p>
                    <p>We just need one <b>clear image</b> of your <b>ID Card</b> and <b>Selfie</b>. </p>
                    <button type="button" class="btn btn-violet close-modal">
                        Get Validated
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
