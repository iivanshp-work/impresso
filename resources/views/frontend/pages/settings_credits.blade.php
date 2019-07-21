@extends("frontend.layouts.app")

@section("htmlheader_title")
    Buy XIMs
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4 class="header-title">Buy XIMs</h4>
            <a href="{{url('/settings')}}" class="header__icon-left">
                <img src="{{url('img/icons/arrow-back.svg')}}" alt="arrow-back">
            </a>
        </header>
        <main class="buy-xim text-center">
            <div class="buy-xim__group-icon">
                <img src="{{url('img/icons/icon-checked.svg')}}" alt="">
                <img src="{{url('img/icons/coffee-cup.svg')}}" alt="">
            </div>
            <p class="mb-7">1 validation = a cup of coffee</p>
            <p>Validate once & never have to do it again. </p>
            <div class="buy-xim__block">
                @php
                    $validation_value = LAConfigs::getByKey('validation_value');
                    if (!$validation_value) $validation_value = 30;
                    $validation_value_price = LAConfigs::getByKey('validation_value_price');
                    if (!$validation_value_price) $validation_value_price = 3;
                @endphp
                <span>1 validation</span>
                <span class="btn btn-white">{{$validation_value}} XIM</span>
                <button data-settings-buy-credits="" class="btn btn-pink">${{$validation_value_price}}</button>
            </div>
            <p>Get your XIMs now to save money & enjoy our upcoming super cool features!</p>
            <p>Remember you can always share the app for more XIMs!</p>
            <a href="{{url('/settings/credits/checkout')}}" class="btn btn-violet" style="margin-bottom: 30px;">Buy XIMs</a>
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
