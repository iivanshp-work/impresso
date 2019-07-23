@extends("la.layouts.app")

@section("contentheader_title", "Jobs")
@section("contentheader_description", "Jobs listing")
@section("section", "Jobs")
@section("sub_section", "Listing")
@section("htmlheader_title", "Jobs Listing")

@section("headerElems")
@la_access("Jobs", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Job</button>
@endla_access
@endsection

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-header" style="margin-bottom: 10px;">
		<div class="box-tools" >
			{!! Form::open(['action' => 'LA\JobsController@index', 'method' => 'get',  'id' => 'jobs-search-form']) !!}
			@php
				$keyword = app('request')->input('keyword');
				$status = app('request')->has('status') ? intval(app('request')->input('status')) : null;
			@endphp
			<div class="input-group dropdown-field-search">
				<label>Status:</label>
				<select name="status" class="form-control input-sm">
					<option value="">All</option>
					<option value="1" @if($status == 1) selected @endif>Active</option>
					<option value="0" @if($status === 0) selected @endif>Inactive</option>
				</select>
			</div>
			<div class="input-group input-group-sm field-search">

				<input type="text" name="keyword" class="form-control pull-right" value="{{$keyword}}" placeholder="Keyword">
				<div class="input-group-btn">
					<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
				</div>
			</div>

            @if($keyword || $status)
                <div class="input-group">
                    <a href="{{url(config('laraadmin.adminRoute') . "/user_certifications")}}" type="submit" class="btn btn-default btn-sm" style="margin-left: 20px;">Clear</a>
                </div>
            @endif

			{!! Form::close() !!}
		</div>
	</div>
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			@if($values)
				@foreach($values as $value)
					<tr>
						@foreach( $listing_cols as $col )
							<td>@if ($col == $view_col){!!$value->$col!!}@else{{$value->$col}}@endif</td>
						@endforeach
						<td>{!!$value->actions!!}</td>
					</tr>
				@endforeach
			@else
				<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty text-center">No records found.</td></tr>
			@endif
		</tbody>
		</table>
		@if($values)
			<ul class="pagination pagination-sm no-margin pull-right">
				@if($keyword || $status)
					{{ $values->appends(['keyword' => $keyword, 'status' => $status])->links() }}
				@else
					{{ $values->links() }}
				@endif
			</ul>
		@endif
	</div>
</div>

@la_access("Jobs", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Job</h4>
			</div>
			{!! Form::open(['action' => 'LA\JobsController@store', 'id' => 'job-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
					{{--@la_form($module)--}}

					@la_input($module, 'job_title')
					@la_input($module, 'company_title')
					@la_input($module, 'short_description')
					@la_input($module, 'description')
					@la_input($module, 'location_title')
					<div><a data-open-gmaps href="#" target="_blank">Open GMaps to get Longitude & Latitude</a><br></div>
					<br>
					@la_input($module, 'longitude')
					@la_input($module, 'latitude')
					@la_input($module, 'status')
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<style>
	[data-open-gmaps]{
		display: none;
	}
	#jobs-search-form {
		display: flex;
		flex-direction: row;
	}
	#jobs-search-form .dropdown-field-search{
		width: 150px;
		display: flex;
		flex-direction: row;
		align-items: center;
	}
	#jobs-search-form .dropdown-field-search select{
		margin: 0 15px;
	}
	#jobs-search-form .field-search{
		width: 150px;
	}
</style>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$('#job-add-form [name="location_title"]').on('change', function(e){
		let val = $(this).val();
		if (val) {
			$("[data-open-gmaps]").show();
			$("[data-open-gmaps]").attr('href', "https://maps.google.com/maps?q="+ encodeURIComponent( val ));
		} else {
			$("[data-open-gmaps]").hide().attr('href', "https://maps.google.com/maps?q=");
		}
	});
	$('#job-add-form [name="location_title"]').change().trigger('change');
	$("#job-add-form").validate({

	});
});
</script>
@endpush
