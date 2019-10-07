@extends("frontend.layouts.app")

@section("htmlheader_title")
    Phone Number Validation
@endsection

@section("main-content")
    <main class="main">
        <div class="location-page" @if ($user && (!$user->location_title || (!$user->longitude && !$user->latitude))) style="opacity: 0;" @endif>
            <div class="location-page__body">
                <form action="{{url('/phone-validation')}}" method="post" data-form-number-form="">
                    <div class="location-page__header">
                        <p>Enter your mobile number</p>
                        <img src="{{asset('img/icons/phone.svg')}}" alt="phone">
                        @php
                            $selectedCountry = '';
                        @endphp
                        <div class="location-page__number">
                            <select name="phone_number_country_code">
                                 @if ($countries)
                                    @foreach($countries as $country)
                                        <option value="+{{$country->country_code}}" @if($user->country_code == $country->country_iso_code){{'selected'}} @php $selectedCountry = $country->country_iso_code;@endphp @endif>{{$country->country_iso_code}} + {{$country->country_code}}</option>
                                    @endforeach
                                @endif
                                 <option value="" @if(!$user->country_code || !$selectedCountry){{'selected'}}@endif>Other</option>
                            </select>
                            <input type="text" name="phone_number" class="location-page__input" placeholder="000 00 00 00">
                        </div>
                    </div>
                    <div class="location-page__footer">
                        <button type="submit" class="btn btn-violet">
                            Submit
                        </button>
                        <a href="{{url(getenv('BASE_LOGEDIN_PAGE'))}}" type="button" class="btn btn-border">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('popups')
@endpush

@push('styles')
    <link rel="stylesheet" type="text/css" href="css/components/jquery.formstyler.css">
@endpush

@push('scripts')
    <script src="js/components/jquery.formstyler.min.js"></script>
@endpush
