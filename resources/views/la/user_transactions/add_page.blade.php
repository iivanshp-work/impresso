@extends("la.layouts.app")

@section("contentheader_title")
    <a href="{{ url(config('laraadmin.adminRoute') . '/user_transactions') }}">User Transaction</a> :
@endsection
@section("contentheader_description", $user_transaction->$view_col)
@section("section", "User Transactions")
@section("section_url", url(config('laraadmin.adminRoute') . '/user_transactions'))
@section("sub_section", "Edit")

@section("htmlheader_title", "User Transactions Edit : ".$user_transaction->$view_col)

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
                    {!! Form::model($user_transaction, ['route' => [config('laraadmin.adminRoute') . '.user_transactions.update', $user_transaction->id ], 'method'=>'PUT', 'id' => 'user_transaction-edit-form']) !!}
                    @la_form($module)

                    {{--
                    @la_input($module, 'user_id')
                    @la_input($module, 'amount')
                    @la_input($module, 'notes')
                    @la_input($module, 'type')
                    @la_input($module, 'by_user_id')
                    --}}
                    <br>
                    <div class="form-group">
                        {!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/user_transactions') }}">Cancel</a></button>
                    </div>
                    {!! Form::close() !!}
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
