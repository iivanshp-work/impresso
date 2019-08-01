@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/jobs') }}">Job</a> :
@endsection
@section("contentheader_description", $job->$view_col)
@section("section", "Jobs")
@section("section_url", url(config('laraadmin.adminRoute') . '/jobs'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Jobs Edit : ".$job->$view_col)

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
				{!! Form::model($job, ['route' => [config('laraadmin.adminRoute') . '.jobs.update', $job->id ], 'method'=>'PUT', 'id' => 'job-edit-form']) !!}
					{{--@la_form($module)--}}

					@la_input($module, 'job_title')
					@la_input($module, 'company_title')
					@la_input($module, 'short_description')
					@la_input($module, 'description')
					@la_input($module, 'location_title')
                    <div style="margin-bottom: 10px;">
                        <a data-auto-gmaps href="#" class="btn btn-primary" >Auto get Longitude & Latitude</a> OR
                        <a data-open-gmaps href="#" class="btn btn-success" target="_blank">Open GMaps to get Longitude & Latitude</a>
                        <br>
                    </div>
					@la_input($module, 'longitude')
					@la_input($module, 'latitude')
					@la_input($module, 'status')

                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jobs') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('styles')
	<style>
		[data-open-gmaps]{
			display: none;
		}
        [data-auto-gmaps]{
            display: none;
        }
	</style>
@endpush
@push('scripts')
<script>
$(function () {
    function getGeo(address) {
        targetLink =
        $.ajax({
            url: "{{ url(config('laraadmin.adminRoute') . '/jobs_get_geo') }}",
            type: 'get',
            data: {address: address},
            dataType: 'json',
            success: function(response){
                if (response.lat && response.lon) {
                    $('#job-edit-form [name="longitude"]').val(response.lon);
                    $('#job-edit-form [name="latitude"]').val(response.lat);
                } else {
                    alert('Can not get Longitude && Latitude, please enter it manually.');
                }
            },
            error: function(){
                alert('Can not get Longitude && Latitude, please enter it manually.');
            },
            complete: function(){
            }
        });
    }
    $(document).on('click change', "[data-auto-gmaps]", function (e) {
        e.preventDefault();
        var geoInfo = getGeo($('#job-edit-form [name="location_title"]').val());
    })
	$('#job-edit-form [name="location_title"]').on('change', function(e){
		let val = $(this).val();
		if (val) {
			$("[data-open-gmaps]").show();
			$("[data-open-gmaps]").attr('href', "https://maps.google.com/maps?q="+ encodeURIComponent( val ));
            $("[data-auto-gmaps]").show();
		} else {
			$("[data-open-gmaps]").hide().attr('href', "https://maps.google.com/maps?q=");
            $("[data-auto-gmaps]").hide();
		}
	});
	$('#job-edit-form [name="location_title"]').change().trigger('change');
	$("#job-edit-form").validate({

	});
});
</script>
@endpush
