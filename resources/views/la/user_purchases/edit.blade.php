@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/user_purchases') }}">User Purchase</a> :
@endsection
@section("contentheader_description", $user_purchase->$view_col)
@section("section", "User Purchases")
@section("section_url", url(config('laraadmin.adminRoute') . '/user_purchases'))
@section("sub_section", "Edit")

@section("htmlheader_title", "User Purchases Edit : ".$user_purchase->$view_col)

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
				{!! Form::model($user_purchase, ['route' => [config('laraadmin.adminRoute') . '.user_purchases.update', $user_purchase->id ], 'method'=>'PUT', 'id' => 'user_purchase-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'user_id')
					@la_input($module, 'purchase_amount')
					@la_input($module, 'payment_id')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/user_purchases') }}">Cancel</a></button>
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
	$("#user_purchase-edit-form").validate({
		
	});
});
</script>
@endpush
