@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/meetups') }}">Meetup</a> :
@endsection
@section("contentheader_description", $meetup->$view_col)
@section("section", "Meetups")
@section("section_url", url(config('laraadmin.adminRoute') . '/meetups'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Meetups Edit : ".$meetup->$view_col)

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
				{!! Form::model($meetup, ['route' => [config('laraadmin.adminRoute') . '.meetups.update', $meetup->id ], 'method'=>'PUT', 'id' => 'meetup-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'unique_code')
					@la_input($module, 'user_id_inviting')
					@la_input($module, 'user_id_invited')
					@la_input($module, 'reason')
					@la_input($module, 'inviting_date')
					@la_input($module, 'invited_date')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/meetups') }}">Cancel</a></button>
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
	$("#meetup-edit-form").validate({
		
	});
});
</script>
@endpush
