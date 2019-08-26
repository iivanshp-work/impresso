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

<div class="modal-window sharePopupData" id="share">
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

<button class="btn btn-violet open-pop-up hide customSharePopup" data-target="#customShare">Custom Share</button>

<div class="modal-window" id="customShare">
    <div class="modal-window__content">
        <div class="modal-window__body text-center">
            <h3>Sharing is caring and you're awesome for doing it!</h3>
            <div class="targets">
                <a data-open-share-link="" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(getenv('SHARE_URL'))}}&amp;t={{getenv('SHARE_TEXT')}}"
                   rel="noopener" class="button btn btn-border">
                    <svg>
                        <use href="#facebook"></use>
                    </svg>
                    <span>Facebook</span>
                </a>
                <a data-open-share-link="" target="_blank" href="https://twitter.com/intent/tweet?url={{urlencode(getenv('SHARE_URL'))}}&amp;text={{urlencode(getenv('SHARE_TEXT'))}}"
                   rel="noopener" class="button btn btn-border">
                    <svg>
                        <use href="#twitter"></use>
                    </svg>
                    <span>Twitter</span>
                </a>
                <a data-open-share-link="" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(getenv('SHARE_URL'))}}&amp;title={{urlencode(getenv('SHARE_TEXT'))}}&amp;summary="
                   rel="noopener" class="button btn btn-border">
                    <svg>
                        <use href="#linkedin"></use>
                    </svg>
                    <span>LinkedIn</span>
                </a>
                <a data-open-share-link="" href="mailto:?subject={{getenv('SHARE_TEXT')}}&body={{getenv('SHARE_URL')}}"
                   rel="noopener" class="button btn btn-border">
                    <svg>
                        <use href="#email"></use>
                    </svg>
                    <span>Email</span>
                </a>
            </div>
            <div class="link">
                <div data-share-link="" class="pen-url">{{getenv('SHARE_URL')}}</div>
                <button data-copy-share-link="" class="copy-link btn btn-violet">Copy Link</button>
            </div>
            <svg class="hide">
                <defs>
                    <symbol id="facebook" viewBox="0 0 24 24" fill="#3b5998" stroke="#3b5998" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></symbol>
                    <symbol id="twitter" viewBox="0 0 24 24" fill="#1da1f2" stroke="#1da1f2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></symbol>
                    <symbol id="email" viewBox="0 0 24 24" fill="#777" stroke="#fafafa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></symbol>
                    <symbol id="linkedin" viewBox="0 0 24 24" fill="#0077B5" stroke="#0077B5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></symbol>
                </defs>
            </svg>
            <button type="button" class="btn btn-border close-modal">
                Cancel
            </button>
        </div>
    </div>
</div>

<button class="btn btn-violet hide open-pop-up shareSuccessPopup" data-target="#shareSuccess">Share success</button>

<div class="modal-window" id="shareSuccess">
    <div class="modal-window__content">
        <div class="modal-window__body text-center">
            <img src="{{asset('img/icons/like.png')}}" alt="like" class="modal-window__img-top" />
            <h3 class="title mb-34">Success!</h3>
            {{--<p>Your invitation has been sent.</p>--}}
            <p>You will earn the XIMs once the people you invited join IMPRESSO.</p>
            <button type="button" class="btn btn-violet close-modal">
                Close
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
