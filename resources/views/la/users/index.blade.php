@extends("la.layouts.app")

@section("contentheader_title", ($mode == "admins" ? "Administrators" : "Users"))
@section("contentheader_description", ($mode == "admins" ? "Administrators listing" : "Users listing"))
@section("section", ($mode == "admins" ? "Administrators" : "Users"))
@section("sub_section", "Listing")
@section("htmlheader_title", ($mode == "admins" ? "Administrators listing" : "Users listing"))

@section("headerElems")
@if($mode == "users")
    <a href="" class="export_btn btn btn-primary btn-sm mr10">Pull a report</a>
@endif
@la_access("Users", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add @if($mode == "admins"){{'Administrator'}}@else{{'User'}}@endif</button>
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
            <form method="GET" action="" accept-charset="UTF-8" id="users-search-form">
            @php
                $keyword = app('request')->input('keyword');
                $date_from = app('request')->input('date_from');
                $date_to = app('request')->input('date_to');
                $status = app('request')->has('status') ? intval(app('request')->input('status')) : null;
            @endphp
            @if ($mode != "admins")
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
                    <option value="1" @if($status == 1) selected @endif>Verified</option>
                    <option value="2" @if($status === 2) selected @endif>Pending Varification</option>
                    <option value="3" @if($status === 3) selected @endif>Not Verified</option>
                    <option value="4" @if($status === 4) selected @endif>Failed Validation</option>
                </select>
            </div>
            @endif
            <div class="input-group input-group-sm field-search">
                <input type="text" name="keyword" class="form-control pull-right" autocomplete="off" value="{{$keyword}}" placeholder="Keyword">
                <div class="input-group-btn">
                    <button type="submit" class="search-btn btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>

            @if($keyword || $status || $date_from || $date_to)
                <div class="input-group">
                    <a href="{{url(config('laraadmin.adminRoute') . "/users")}}" type="submit" class="btn btn-default btn-sm" style="margin-left: 20px;">Clear</a>
                </div>
            @endif

            {!! Form::close() !!}
        </div>
    </div>
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $fields as $col )
			<th>@if($col == 'credits_count'){{'Credits'}}@elseif($col == 'created_at'){{'Sign Up'}}@else{{ $module->fields[$col]['label'] or ucfirst($col) }}@endif</th>
			@endforeach
			@if($show_actions)
			<th width="230">Actions</th>
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
                                @elseif($col == 'credits_count')
                                    @php
                                        $creditsCount = $value->$col;
                                        if ((int)$creditsCount == $creditsCount) {
                                            $creditsCount = round($creditsCount,2);
                                        } else {
                                            $creditsCount = number_format($creditsCount,2, ',', '.');
                                        }
                                    @endphp
                                    {{$creditsCount}}
                                @elseif($col == 'created_at')
                                    {{Carbon::parse($value->$col)->format('Y/m/d H:i')}}
                                @elseif($col == 'status')
                                    @if ($value->is_verified)
                                        Verified
                                    @elseif($value->fail_validation)
                                        Failed Validation
                                    @elseif($value->varification_pending && !$value->is_verified)
                                        Pending Varification
                                    @else
                                        Not Verified
                                    @endif

                                @else
                                    {{$value->$col}}
                                @endif
                            </td>
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
                @if($keyword || $status || $date_from || $date_to)
                    {{ $values->appends(['keyword' => $keyword, 'status' => $status, 'date_from' => $date_from, 'date_to' => $date_to])->links() }}
                @else
                    {{ $values->links() }}
                @endif
            </ul>
        @endif
	</div>
</div>

@la_access("Users", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add @if($mode == "admins"){{'Administrator'}}@else{{'User'}}@endif</h4>
			</div>
			{!! Form::open(['action' => 'LA\UsersController@store', 'id' => 'user-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    {{--@la_form($module)--}}
                    @la_input($module, 'name')
                    @la_input($module, 'email')
                    @la_input($module, 'password')
                    <input type="hidden" name="type" value="{{$mode == "admins" ? getenv('USERS_TYPE_ADMIN') : getenv('USERS_TYPE_USER')}}">
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
<link rel="stylesheet" href="{{ asset('la-assets/plugins/datepicker/datepicker3.css') }}">
<style>
    #users-search-form {
        display: flex;
        flex-direction: row;
    }
    #users-search-form .dropdown-field-search{
        width: 150px;
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    #users-search-form .dropdown-field-search select{
        margin: 0 15px;
    }
    #users-search-form .field-search{
        width: 150px;
    }
    #users-search-form .date-search{
        display: flex;
        align-items: baseline;
    }
    #users-search-form .date-search input{
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
	$("#user-add-form").validate({

	});


    $(document).on('click change', '.search-btn', function(e) {
        e.preventDefault();
        var frm = $('#users-search-form');
        frm.find('[name="action"]').remove();
        setTimeout(function () {
            frm.submit();
        }, 200)
    });
    $(document).on('click change', '.export_btn', function(e) {
        e.preventDefault();
        var frm = $('#users-search-form');
        frm.append('<input type="hidden" name="action" value="export">');
        frm.submit();
    });

});
</script>
@endpush
