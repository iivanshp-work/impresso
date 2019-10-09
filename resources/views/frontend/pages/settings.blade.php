@extends("frontend.layouts.app")

@section("htmlheader_title")
    Settings
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4 class="header-title">Settings</h4>
            <a href="{{url('/profile')}}" class="header__icon-left">
                <img src="{{url('img/icons/arrow-back.svg')}}" alt="arrow-back">
            </a>
        </header>
        <main class="settings">
            <div class="user__header">
                <div class="user__avatar">
                    @if($userData->photo)
                        <img src="{{url('/files/' . $userData->photo . '?s=200')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
                    @else
                        <img src="{{asset('img/icons/icon-user.png')}}" alt="@if($userData->name){{$userData->name}}@else{{$userData->email}}@endif"/>
                    @endif
                </div>
                @if($userData->is_verified)
                    <span class="user__checked">
                        <img src="{{url('img/icons/icon-checked.svg')}}" alt="" />
                    </span>
                @endif
            </div>
            <h4 class="user__name text-center @if(!$userData->is_verified){{'not_verified'}}@endif">@if($userData->name){{$userData->name}}@else{{'None'}}@endif</h4>
            <ul class="settings__list" style="margin-bottom: 0;">
                <li>
                    <span>Profile:</span>
                    <a href="{{url('/settings/edit')}}">Personal Details</a>
                </li>
                <li>
                    <span>Upgrade:</span>
                    <a href="{{url('/settings/credits')}}">Buy XIM</a>
                </li>
                <li>
                    <span>Legal:</span>
                    <a href="https://www.impressolabs.io/app-terms-conditions">Terms and Conditions</a>
                    <a href="https://www.impressolabs.io/privacy">Privacy Policy</a>
                    <a href="https://www.impressoapp.com/copyrights">Credits & Copyrights</a>
                </li>
                <li>
                    <span>Contact:</span>
                    <a href="https://www.impressoapp.com/feedback">Feedback</a>
                </li>
                <li>
                    <a href="#" class="open-pop-up" data-target="#logOut">Log Out</a>
                </li>
            </ul>
            {{--
            <div class="text-center">
                <a href="{{url('/')}}" class="logo-bottom"><img src="{{url('img/logo-small.png')}}" alt=""></a>
                <span class="text-center version">VERSION: {{getenv('APP_VERSION')}}</span>
            </div>
            --}}
        </main>
    </div>
@endsection

@push('popups')

    <div class="modal-window" id="logOut">
        <div class="modal-window__content">
            <div class="modal-window__body text-center log-out">
                <p>You are about to log out.</p>
                <p>Are you sure?</p>
                <div class="line"></div>
                <a href="{{url('/logout')}}" class="btn btn-violet">
                    Continue
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
