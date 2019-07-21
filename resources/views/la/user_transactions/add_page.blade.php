@extends("la.layouts.app")

@section("contentheader_title")
    <a href="{{ url(config('laraadmin.adminRoute') . '/user_transactions') }}">{{"Adding User Transactions : "}}</a>
@endsection
@section("contentheader_description", ($selectedUser ? $selectedUser->name : ''))
@section("section", "User Transactions")
@section("section_url", url(config('laraadmin.adminRoute') . '/user_transactions'))
@section("sub_section", "Add")

@section("htmlheader_title", "Adding User Transactions : ". ($selectedUser ? $selectedUser->name : ''))

@section("main-content")

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box">
        <div class="box-header">

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @php
                        $url = app('request')->url();
                        if($purchase_id) {
                            $url .= '/manual';
                        } else if(!$purchase_id && $selectedUser) {
                            $url .= '?selected_user_id=' . $selectedUser->id;
                        }
                    @endphp
                    <form method="POST" action="{{$url}}" accept-charset="UTF-8" id="user_transaction-edit-form" novalidate="novalidate">
                        <input name="_token" type="hidden" value="{{csrf_token()}}">
                        @if ($selectedUser)
                            <div class="form-group">
                                <label for="status">User :</label>
                                <input type="text" class="form-control" value="{{$selectedUser->id}} - {{$selectedUser->name}}" readonly="">
                            </div>
                        @endif
                        @if($purchase_id)
                            <input type="hidden" name="purchase_id" value="{{$purchase_id}}">
                        @endif

                        <div class="form-group">
                            <label for="type">Type* :</label>
                            @if($userPurchase) <input type="hidden" name="type" value="{{'purchase'}}"> @endif
                            <select class="form-control valid" required="1" name="type" @if($userPurchase) disabled @endif>
                                <option value=""> Type </option>
                                @foreach($types as $key => $type)
                                    <option value="{{$key}}" @if(!$userPurchase && (in_array($key, ["purchase", "validation_education", "validation_certificate", "user_validation"]))) disabled @endif @if($userPurchase && $key == "purchase") selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount(XIMs)* :</label>
                            <small>the negative value will be subtracting the user balance</small>
                            <input class="form-control valid" placeholder="Amount" name="amount" type="number" value="@if($userPurchase){{LAConfigs::getByKey('validation_value')}}@endif" aria-invalid="false">
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes :</label>
                            <textarea class="form-control valid" placeholder="Notes" cols="30" rows="3" name="notes" aria-invalid="false">@if($userPurchase){{'Accrual of credits for user purchase #' . $userPurchase->id}}@endif</textarea>
                        </div>

                        <br>
                        <div class="form-group">
                            {!! Form::submit( 'Save', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/user_transactions') }}">Cancel</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {
            $("#user_transaction-edit-form").validate({

            });
        });
    </script>
@endpush
