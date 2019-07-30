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
        <main class="checkout-page">
            <form id="checkout_settings_form" action="{{url('/settings/credits/checkout')}}" method="post" data-edit-settings-form="">
                <ul class="settings__list settings__checkout__list">
                    @php
                        $validation_value = $purchaseType->xims_amount;
                        if (!$validation_value) $validation_value = 30;
                        $validation_value_price = $purchaseType->price;
                        if (!$validation_value_price) $validation_value_price = 3;
                    @endphp
                    <li>
                        <div class="xims_total_wrapper">
                            <div class="xims_amount">
                                <span>Amount of XIMs:</span>
                                <input type="text" class="style-input-text" readonly="" value="{{$validation_value}}" autocomplete="off" name="amount" placeholder="Amount" >
                                <input type="hidden" class="" readonly="" value="{{$purchaseType->id}}" autocomplete="off" name="purchase_type_id">
                            </div>
                            <div class="xims_total">
                                <span>Total:</span>
                                <input type="text" class="style-input-text" readonly="" value="$ {{$validation_value_price}}" autocomplete="off" name="price" placeholder="Price" >
                            </div>
                        </div>
                    </li>
                    <li>
                        <span>Credit Card Number:</span>
                        <input type="text" class="style-input-text" data-required-fields="" value="" autocomplete="off" name="card_no" placeholder="CREDIT CART" >
                    </li>
                    <li class="expiry_date">
                        <span>Expiry Date:</span>
                        <input type="text" class="style-input-text" data-required-fields="" value="" autocomplete="off" name="exp_month" placeholder="YY" >
                        -
                        <input type="text" class="style-input-text exp_year" data-required-fields="" value="" autocomplete="off" name="exp_year" placeholder="YY" >
                    </li>
                    <li>
                        <span>CVV:</span>
                        <input type="text" class="style-input-text" data-required-fields="" value="" autocomplete="off" name="cvv" placeholder="CVV" >
                    </li>
                </ul>
                <div class="settings_edit_submit">
                    <button data-settings-buy-credits="" type="submit" id="buy" class="btn btn-violet btn-buy">Buy XIMS</button>
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
    <script src="{{ asset('/js/components/jquery.mask.js') }}"></script>
@endpush
