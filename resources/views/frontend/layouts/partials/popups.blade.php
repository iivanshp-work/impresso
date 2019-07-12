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
@stack('popups')
