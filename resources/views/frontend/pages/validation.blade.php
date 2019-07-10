@extends("frontend.layouts.app")

@section("htmlheader_title")
    Validation
@endsection

@section("main-content")
    <main class="main">
        <form id="validationForm" class="validation text-center">
            <div id="step1" class="validation__step validation__step_first">
                <h2 class="validation__title">Profile Validation</h2>
                <p>Verify your identity in order to use the App</p>
                <div class="validation__user-img">
                    <img src="{{ asset('img/icons/user-icon.svg') }}" alt="user-icon"/>
                </div>
                <p class="validation__text">
                    1. Upload a clear photo of your ID
                </p>
                <p class="validation__text">
                    2. Take a selfie together with the uploaded ID
                </p>
                <div class="validation__btn">
                    <span class="open-pop-up" data-target="#validationMyProfile">Why do I need to do this?</span>
                    <button type="button" data-validation-step="step2" class="btn btn-violet" data-target="#validationMyProfile">
                        Validate my profile
                    </button>
                </div>
            </div>
            <div id="step2" class="validation__step">
                <header class="header">
                    <h4>Profile Validation</h4>
                    <span class="header__icon-left" data-validation-step="step1">
                        <img src="{{ asset('img/icons/arrow-back.svg') }}" alt="arrow-back"/>
                    </span>
                </header>
                <p>Step 1 / 2</p>
                <div class="validation__icon">
                    <img src="{{ asset('img/icons/icon-form.svg') }}" alt=""/>
                </div>
                <p>1. Upload a clear photo of your ID</p>
                <p class="text-gray">
                    Accepted IDs: national ID, passport and driver’s license.
                </p>
                <div class="validation__group-btn">
                    <input type="file" data-validation-send-file-hidden="" data-image-id="photo_id">
                    <button type="button" class="btn btn-violet" data-validation-send-file="">
                        Upload ID photo
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
                <p>1. Upload a clear photo of your ID</p>
                <p class="text-gray">
                    Accepted IDs: national ID, passport and driver’s license.
                </p>
                <div class="validation__group-btn">
                    <button type="button" class="btn btn-violet" data-validation-step="step4">
                        Upload ID photo
                    </button>
                    <input type="file" data-validation-send-file-hidden="" data-image-id="photo_id">
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
                <div class="validation__icon validation__icon_big">
                    <img src="{{ asset('img/icons/icon-form-2.svg') }}" alt=""/>
                </div>
                <p>2. Take a selfie with the same ID</p>
                <p class="text-gray">
                    This will not be used as your profile photo and nobody else will be able to see it.
                </p>
                <div class="validation__group-btn">
                    <input type="file" data-validation-send-file-hidden="" data-image-id="photo_selfie">
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
                <p>2. Take a selfie with the same ID</p>
                <p class="text-gray">
                    This will not be used as your profile photo and nobody else will be able to see it.
                </p>
                <div class="validation__group-btn">
                    <button type="button" class="btn btn-violet" data-validation-check="">
                        Upload photo
                    </button>
                    <input type="file" data-validation-send-file-hidden="" data-image-id="photo_selfie">
                    <button type="button" class="btn btn-border" data-validation-send-file="">
                        Retake
                    </button>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('popups')
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

    <div class="modal-window" id="validationMyProfile">
        <div class="modal-window__content">
            <div class="modal-window__body validation-modal text-center">
                <h3 class="title mb-34">
                    Why validate?
                </h3>
                <p>
                    IMPRESSO is all about validated information, so we can provide you with the most accurate and
                    valid data only.
                </p>
                <p>
                    The validation process is secure and your personal information will not be shared with anyone.
                </p>
                <p>
                    You can skip the validation process, however, you will miss out on important app features.
                </p>
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
