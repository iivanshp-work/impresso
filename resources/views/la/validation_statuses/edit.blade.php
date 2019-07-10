@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/validation_statuses') }}">Validation status</a> :
@endsection
@section("contentheader_description", $validation_status->$view_col)
@section("section", "Validation statuses")
@section("section_url", url(config('laraadmin.adminRoute') . '/validation_statuses'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Validation statuses Edit : ".$validation_status->$view_col)

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
				{!! Form::model($validation_status, ['route' => [config('laraadmin.adminRoute') . '.validation_statuses.update', $validation_status->id ], 'method'=>'PUT', 'id' => 'validation_status-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'title')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/validation_statuses') }}">Cancel</a></button>
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
	$("#validation_status-edit-form").validate({
		
	});
});
</script>
@endpush
