@extends("frontend.layouts.app")

@section("htmlheader_title")
    Personal Details
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4 class="header-title">Personal Details</h4>
            <span class="header__icon-left">
                <a href="{{url('/settings')}}"><img src="{{asset('img/icons/settings.svg')}}" alt="" class="settings-icon" /></a>
            </span>
        </header>
        <main class="personal-details">
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
                        <img src="{{asset('img/icons/icon-checked.svg')}}" alt="" />
                    </span>
                @endif
            </div>
            <form id="edit_settings_form" action="{{url('/settings/edit')}}" method="post" data-edit-settings-form="">
                <ul class="personal-details__list">
                    <li>
                        <span>Full Name & Date of Birth</span>
                        <input type="text" class="style-input-text" value="{{$userData->full_name_birth}}" autocomplete="off" name="full_name_birth" placeholder="Full Name & Date of Birth" >
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                    </li>
                    <li>
                        <span>Address</span>
                        <input type="text" class="style-input-text address-text" value="{{$userData->address2}}" autocomplete="off" name="address2" placeholder="Address Line 2" >
                        <input type="text" class="style-input-text address-text" value="{{$userData->city}}" autocomplete="off" name="city" placeholder="City, Country" >
                        <input type="text" class="style-input-text address-text" value="{{$userData->address}}" autocomplete="off" name="address" placeholder="Address Line" >
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                    </li>
                    <li>
                        <span>Phone Number</span>
                        <input type="text" class="style-input-text" value="{{$userData->phone}}" autocomplete="off" name="phone" placeholder="Phone Number" >
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                    </li>
                    <li>
                        <span>Email</span>
                        <input type="text" class="style-input-text" value="{{$userData->email}}" autocomplete="off" name="email" placeholder="Email" >
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                    </li>
                </ul>
                <div class="settings_edit_submit">
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