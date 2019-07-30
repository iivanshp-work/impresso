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
            <p>Validate once & never have to do it again. </p>
            @if($purchaseTypes)
                <div class="buy-xims-block">
                    @foreach($purchaseTypes as $purchaseType)
                        <div class="buy-xim__block">
                            <span>{!! nl2br($purchaseType->title) !!}</span>
                            <span class="btn btn-white">{{$purchaseType->xims_amount}} XIM</span>
                            <a href="{{url('/settings/credits/checkout')}}" class="btn btn-pink @if(!$purchaseType->save_text) btn-initial @endif">${{$purchaseType->price}}<span class="save">@if($purchaseType->save_text){{$purchaseType->save_text}}@else&nbsp;@endif</span></a>
                            <a href="{{url('/settings/credits/checkout?type=' . $purchaseType->id)}}" class="full-link"></a>
                        </div>
                    @endforeach
                </div>
            @else
                Not able to buy credits now.
            @endif
            <p>Remember you can always share the app for more XIMs!</p>
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
