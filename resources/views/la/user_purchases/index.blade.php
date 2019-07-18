@extends("la.layouts.app")

@section("contentheader_title", ($selectedUser ? $selectedUser->name . ' Purchases' : "Users Purchases"))
@section("contentheader_description", "Listing")
@section("section", ($selectedUser ? $selectedUser->name . ' Purchases' : "Users Purchases"))
@section("sub_section", "Listing")
@section("htmlheader_title", ($selectedUser ? $selectedUser->name . ' Purchases' : "Users Purchases"))

@section("headerElems")
@if($selectedUser)
	<a href="{{ url(config('laraadmin.adminRoute') . '/users/' . $selectedUser->id . '/edit') }}" class="btn btn-success btn-sm pull-right">Edit User</a>
@endif
{{--@la_access("User_Purchases", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add User Purchase</button>
@endla_access--}}
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
    @if (!$selectedUser)
        <div class="box-header" style="margin-bottom: 10px;">
            <div class="box-tools" >
                {!! Form::open(['action' => 'LA\User_PurchasesController@index', 'method' => 'get',  'id' => 'user_purchase-search-form']) !!}
                @php
                    $keyword = app('request')->input('keyword');
                    $status = app('request')->has('status') ? intval(app('request')->input('status')) : null;
                    $date_from = app('request')->input('date_from');
                    $date_to = app('request')->input('date_to');
                @endphp
                <div class="input-group date-search">
                    <label>From:</label>
                    <input type="text" name="date_from" class="form-control datepicker" autocomplete="off" value="@if($date_from){{Carbon::parse($date_from)->format('Y/m/d')}}@endif" placeholder="From">
                    <label>To:</label>
                    <input type="text" name="date_to" class="form-control datepicker" autocomplete="off" value="@if($date_to){{Carbon::parse($date_to)->format('Y/m/d')}}@endif" placeholder="To">
                </div>
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
                @if($keyword || $status || $date_from || $date_to)
                    <div class="input-group">
                        <a href="{{url(config('laraadmin.adminRoute') . "/user_purchases")}}" type="submit" class="btn btn-default btn-sm" style="margin-left: 20px;">Clear</a>
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
                <th>Date</th>
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
                        <td>@if ($col == $view_col){!!$value->$col!!}@else{{$value->$col}}@endif</td>
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
                    {{ $values->appends(['selected_user_id' => $selected_user_id])->links() }}
                @elseif($keyword || $status || $date_from || $date_to)
                    {{ $values->appends(['keyword' => $keyword, 'status' => $status])->links() }}
                @else
                    {{ $values->links() }}
                @endif
            </ul>
        @endif
	</div>
</div>

{{--@la_access("User_Purchases", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add User Purchase</h4>
			</div>
			{!! Form::open(['action' => 'LA\User_PurchasesController@store', 'id' => 'user_purchase-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
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
@endla_access--}}

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('la-assets/plugins/datepicker/datepicker3.css') }}">
    <style>
        .wrapper {
            width: 100%;
        }
        #user_purchase-search-form {
            display: flex;
            flex-direction: row;
        }
        #user_purchase-search-form .dropdown-field-search{
            width: 150px;
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        #user_purchase-search-form .dropdown-field-search select{
            margin: 0 15px;
        }
        #user_purchase-search-form .field-search{
            width: 150px;
        }
        #user_purchase-search-form .date-search{
            display: flex;
            align-items: baseline;
        }
        #user_purchase-search-form .date-search input{
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
	$("#user_purchase-add-form").validate({

	});
});
</script>
@endpush
