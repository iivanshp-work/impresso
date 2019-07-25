<div class="modal-window" id="customValidateSuccess">
    <div class="modal-window__content">
        <div class="modal-window__body text-center">
            <h3 class="title mb-34 custom-title">Success!</h3>
            <div class=""><p class="custom-message"></p></div>
            <button type="button" class="btn btn-violet close-modal" data-callback-button="" >
                Close
            </button>
        </div>
    </div>
</div>
<button class="btn btn-violet open-pop-up hide customValidateSuccess" data-target="#customValidateSuccess">Custom Validate success</button>

<div class="modal-window" id="customValidateError">
    <div class="modal-window__content">
        <div class="modal-window__body text-center">
            <h3 class="title mb-34 custom-title">Error!</h3>
            <div class=""><p class="custom-message"></p></div>
            <button type="button" class="btn btn-violet close-modal" data-callback-button="" >
                Close
            </button>
        </div>
    </div>
</div>
<button class="btn btn-violet open-pop-up hide customValidateError" data-target="#customValidateError">Custom Validate error</button>

<div class="modal-window" id="customValidateConfirm">
    <div class="modal-window__content">
        <div class="modal-window__body text-center">
            <h3 class="title mb-34 custom-title">Error!</h3>
            <div class=""><p class="custom-message"></p></div>
            <button type="button" data-callback-button="" class="custom-button btn btn-violet close-modal">
                Continue
            </button>
            <button type="button" class="btn btn-border close-modal">
                Close
            </button>
        </div>
    </div>
</div>
<button class="btn btn-violet open-pop-up hide customValidateConfirm" data-target="#customValidateConfirm">Custom Validate Confirm</button>

<button class="btn btn-violet open-pop-up hide sharePopup" data-target="#share">Share</button>

<div class="modal-window" id="share">
    <div class="modal-window__content">
        <div class="modal-window__body text-center">
            <img src="{{asset('img/icons/icon.svg')}}" alt="" class="modal-window__img-top" />
            <h3>Sharing is caring and you’re awesome for doing it!</h3>
            <p>
                This is why we reward you every time you share IMPRESSO with someone.
            </p>
            <button type="button" data-share-btn="" class="btn btn-violet">
                Share IMPRESSO
            </button>
            <button type="button" class="btn btn-border close-modal">
                Cancel
            </button>
        </div>
    </div>
</div>


@php
    $user = Auth::user();
@endphp
@if ($user && (!$user->location_title || (!$user->longitude && !$user->latitude)))
    <div class="modal-window" id="allowLocationAccess">
        <div class="modal-window__content">
            <div class="modal-window__body location text-center">
                <h3 class="location__title">
                    Allow Location Access
                </h3>
                <img src="{{asset('img/icons/location.svg')}}" alt="location" class="location__icon" />
                <p>
                    In order to use IMPRESSO, you need to enable your location.
                </p>
                <button data-allow-location="" type="button" class="btn btn-violet">
                    Allow
                </button>
                <button type="button" class="btn btn-border close-modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <button class="btn btn-violet open-pop-up hide allowLocationAccess" data-target="#allowLocationAccess">Location</button>
@endif
@stack('popups')
