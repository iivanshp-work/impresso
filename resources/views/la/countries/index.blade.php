@extends("la.layouts.app")

@section("contentheader_title", "Countries")
@section("contentheader_description", "Countries listing")
@section("section", "Countries")
@section("sub_section", "Listing")
@section("htmlheader_title", "Countries Listing")

@section("headerElems")
@la_access("Countries", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Country</button>
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
	<div class="box-header" style="margin-bottom: 10px;">
		<div class="box-tools" >
			{!! Form::open(['action' => 'LA\CountriesController@index', 'method' => 'get',  'id' => 'countries-search-form']) !!}
			@php
				$keyword = app('request')->input('keyword');
			@endphp
			<div class="input-group input-group-sm field-search">
				<input type="text" name="keyword" class="form-control pull-right" value="{{$keyword}}" placeholder="Keyword">
				<div class="input-group-btn">
					<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
				</div>
			</div>

			@if($keyword)
				<div class="input-group">
					<a href="{{url(config('laraadmin.adminRoute') . "/countries")}}" type="submit" class="btn btn-default btn-sm" style="margin-left: 20px;">Clear</a>
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
				@if($keyword)
					{{ $values->appends(['keyword' => $keyword])->links() }}
				@else
					{{ $values->links() }}
				@endif
			</ul>
		@endif
	</div>
</div>

@la_access("Countries", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Country</h4>
			</div>
			{!! Form::open(['action' => 'LA\CountriesController@store', 'id' => 'country-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'country')
					@la_input($module, 'country_code')
					@la_input($module, 'country_iso_code')
					--}}
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

@endpush

@push('scripts')
	<style>
		#countries-search-form {
			display: flex;
			flex-direction: row;
		}
		#countries-search-form .field-search{
			width: 150px;
		}
	</style>
<script>
$(function () {
	$("#country-add-form").validate({
		
	});
});
</script>
@endpush
