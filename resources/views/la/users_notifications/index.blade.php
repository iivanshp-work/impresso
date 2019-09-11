@extends("la.layouts.app")


@section("contentheader_title", ($selectedUser ? $selectedUser->name . ' Notifications' : "Users Notifications"))
@section("contentheader_description", "Listing")
@section("section", ($selectedUser ? $selectedUser->name . ' Notifications' : "Users Notifications"))
@section("sub_section", "Listing")
@section("htmlheader_title", ($selectedUser ? $selectedUser->name . ' Notifications' : "Users Notifications"))

@section("headerElems")
	@if($selectedUser)
		<a href="{{ url(config('laraadmin.adminRoute') . '/users/' . $selectedUser->id . '/edit') }}" class="btn btn-success btn-sm pull-right">Edit User</a>

		@la_access("Users_Notifications", "create")
		<a href="{{url(config('laraadmin.adminRoute') . '/users_notifications/add/new?selected_user_id=' . $selectedUser->id)}}" class="btn btn-success btn-sm pull-right margin-r-5">Add User Notification</a>
		@endla_access
	@endif
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
	@if ($selectedUser)
		@php
			$selected_user_id = app('request')->input('selected_user_id');
		@endphp
		<div class="box-header" style="margin-bottom: 10px;">
			<div class="box-tools" >
				{!! Form::open(['action' => 'LA\Users_NotificationsController@index', 'method' => 'get',  'id' => 'user_notification-search-form']) !!}
				@php
					$keyword = app('request')->input('keyword');
                    $date_from = app('request')->input('date_from');
                    $date_to = app('request')->input('date_to');
				@endphp
				<input type="hidden" name="selected_user_id" value="{{$selected_user_id}}">
				<div class="input-group date-search">
					<label>From:</label>
					<input type="text" name="date_from" class="form-control datepicker" autocomplete="off" value="@if($date_from){{Carbon::parse($date_from)->format('Y/m/d')}}@endif" placeholder="From">
					<label>To:</label>
					<input type="text" name="date_to" class="form-control datepicker" autocomplete="off" value="@if($date_to){{Carbon::parse($date_to)->format('Y/m/d')}}@endif" placeholder="To">
				</div>
				<div class="input-group input-group-sm field-search">
					<input type="text" name="keyword" class="form-control pull-right" value="{{$keyword}}" placeholder="Keyword">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					</div>
				</div>
				@if($keyword || $date_from || $date_to)
					<div class="input-group">
						<a href="{{url(config('laraadmin.adminRoute') . "/users_notifications?selected_user_id=" . $selected_user_id)}}" type="submit" class="btn btn-default btn-sm" style="margin-left: 20px;">Clear</a>
					</div>
				@endif

				{!! Form::close() !!}
			</div>
		</div>
	@endif
		<div class="box-body">
			<table id="example1" class="table table-bordered">
				<thead>
				<tr class="success">
					@foreach( $fields as $col )
						<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
					@endforeach
					<th>Date</th>
					@if($show_actions)
						<th width="50">Actions</th>
					@endif
				</tr>
				</thead>
				<tbody>
				@if($values)
					@foreach($values as $value)
						<tr>
							@foreach( $fields as $col )
								<td>
									@if ($col == $view_col)
										{!!$value->$col!!}
									@else
										{{$value->$col}}
									@endif
								</td>
							@endforeach
							<td>{{Carbon::parse($value->created_at)->format('Y/m/d H:i')}}</td>
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
						@if($keyword || $date_from || $date_to)
							{{ $values->appends(['selected_user_id' => $selected_user_id, 'keyword' => $keyword, 'date_from' => $date_from, 'date_to' => $date_to])->links() }}
						@else
							{{ $values->appends(['selected_user_id' => $selected_user_id])->links() }}
						@endif
					@else
						{{ $values->links() }}
					@endif
				</ul>
			@endif
		</div>
</div>

@endsection

@push('styles')
	<link rel="stylesheet" href="{{ asset('la-assets/plugins/datepicker/datepicker3.css') }}">
	<style>
		.wrapper {
			width: 100%;
		}
		#user_notification-search-form {
			display: flex;
			flex-direction: row;
		}
		#user_notification-search-form .dropdown-field-search{
			width: 150px;
			display: flex;
			flex-direction: row;
			align-items: center;
		}
		#user_notification-search-form .dropdown-field-search select{
			margin: 0 15px;
		}
		#user_notification-search-form .field-search{
			width: 150px;
		}
		#user_notification-search-form .date-search{
			display: flex;
			align-items: baseline;
		}
		#user_notification-search-form .date-search input{
			height: 27px;
			padding: 3px 8px;
			font-size: 13px;
			line-height: 1.5;
			border-radius: 3px;
			margin: 0 10px;
		}
	</style>
@endpush

@push('scripts')
	<script src="{{ asset('la-assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<script>
		$(function () {
			$('.datepicker').datepicker({
				format: "yyyy/mm/dd"
			});
		});
	</script>
@endpush
