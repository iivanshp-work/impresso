@extends("frontend.layouts.app")

@section("htmlheader_title")
    Checkout
@endsection

@section("main-content")
    <div class="main">
        <header class="header">
            <h4 class="header-title">Checkout</h4>
            <a href="{{url()->previous()}}" class="header__icon-left">
                <img src="{{url('img/icons/arrow-back.svg')}}" alt="arrow-back">
            </a>
        </header>
        <main class="checkout">
            <form id="edit_settings_form" action="{{url('/settings/credits/checkout')}}" method="post" data-edit-settings-form="">
                <ul class="personal-details__list">
                    <li>
                        <span>CREDIT CART</span>
                        <input type="text" class="style-input-text" value="{{$userData->full_name_birth}}" autocomplete="off" name="card_no" placeholder="CREDIT CART" >
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                    </li>
                    <li>
                        <span>EXPIRATION</span>
                        <input type="text" class="style-input-text" value="{{$userData->phone}}" autocomplete="off" name="exp" placeholder="EXPIRATION" >
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                    </li>
                    <li>
                        <span>CVV</span>
                        <input type="text" class="style-input-text" value="{{$userData->phone}}" autocomplete="off" name="cvv" placeholder="CVV" >
                        <span class="edit-info"><img src="{{asset('img/icons/pen.svg')}}" alt="" /></span>
                    </li>
                </ul>
                <div class="settings_edit_submit">
                    <button data-settings-buy-credits="" type="submit" id="save" class="btn btn-violet btn-save">Buy XIMS</button>
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
