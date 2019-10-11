@extends("la.layouts.app")

@section("contentheader_title", ($selectedUser ? $selectedUser->name . ' Resumes' : "Users Resumes"))
@section("contentheader_description", "Listing")
@section("section", ($selectedUser ? $selectedUser->name . ' Resumes' : "Users Resumes"))
@section("sub_section", "Listing")
@section("htmlheader_title", ($selectedUser ? $selectedUser->name . ' Resumes' : "Users Resumes"))

@section("headerElems")
	@if($selectedUser)
		<a href="{{ url(config('laraadmin.adminRoute') . '/users/' . $selectedUser->id . '/edit') }}" class="btn btn-success btn-sm pull-right">Edit User</a>
	@endif
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
	@if (!$selectedUser)
		<div class="box-header" style="margin-bottom: 10px;">
			<div class="box-tools" >
				{!! Form::open(['action' => 'LA\User_ResumesController@index', 'method' => 'get',  'id' => 'user_resumes-search-form']) !!}
				@php
					$keyword = app('request')->input('keyword');
                    $status = app('request')->has('status') ? intval(app('request')->input('status')) : null;
				@endphp
				<div class="input-group dropdown-field-search">
					<label>Status:</label>
					<select name="status" class="form-control input-sm">
						<option value="">All</option>
						@if($statuses)
							@foreach($statuses as $key => $statusItem)
								<option value="{{$key}}" @if($status == $key) selected="selected" @endif>{{$statusItem}}</option>
							@endforeach
						@endif
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
						<a href="{{url(config('laraadmin.adminRoute') . "/user_resumes")}}" type="submit" class="btn btn-default btn-sm" style="margin-left: 20px;">Clear</a>
					</div>
				@endif

				{!! Form::close() !!}
			</div>
		</div>
	@else
		@php
			$selected_user_id = app('request')->input('selected_user_id');
		@endphp
	@endif
	<div class="box-body">
		<table id="example1" class="table table-bordered">
			<thead>
			<tr class="success">
				@foreach( $listing_cols as $col )
					@if($selectedUser && $col == 'user_id')
						@continue
					@endif
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
							@if($selectedUser && $col == 'user_id')
								@continue
							@endif
							<td>@if ($col == $view_col  || $col == 'user_id'){!!$value->$col!!}@else{{$value->$col}}@endif</td>
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
				@if($selectedUser)
					{{ $values->appends(['selected_user_id' => $selected_user_id])->links() }}
				@elseif($keyword || $status)
					{{ $values->appends(['keyword' => $keyword, 'status' => $status])->links() }}
				@else
					{{ $values->links() }}
				@endif
			</ul>
		@endif
	</div>
</div>

@endsection

@push('styles')
	<style>
		.wrapper {
			width: 100%;
		}
		#user_resumes-search-form {
			display: flex;
			flex-direction: row;
		}
		#user_resumes-search-form .dropdown-field-search{
			width: 150px;
			display: flex;
			flex-direction: row;
			align-items: center;
		}
		#user_resumes-search-form .dropdown-field-search select{
			margin: 0 15px;
		}
		#user_resumes-search-form .field-search{
			width: 150px;
		}
	</style>
@endpush

@push('scripts')
<script>
$(function () {

});
</script>
@endpush
