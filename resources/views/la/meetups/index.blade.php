@extends("la.layouts.app")

@section("contentheader_title", "Meetups")
@section("contentheader_description", "Meetups listing")
@section("section", "Meetups")
@section("sub_section", "Listing")
@section("htmlheader_title", "Meetups Listing")

@section("headerElems")
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
            {!! Form::open(['action' => 'LA\MeetupsController@index', 'method' => 'get',  'id' => 'meetups-search-form']) !!}
            @php
                $keyword = app('request')->input('keyword');
                $status = app('request')->has('status') ? intval(app('request')->input('status')) : null;
                $reason = app('request')->has('reason') ? intval(app('request')->input('reason')) : null;
                $date_from = app('request')->has('date_from') ? app('request')->input('date_from') : null;
                $date_to = app('request')->has('date_to') ? app('request')->input('date_to') : null;
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
                    @if ($statuses)
                        @foreach($statuses as $key => $item)
                            <option value="{{$key}}" @if($key == $status) selected @endif>{{$item}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="input-group dropdown-field-search">
                <label>Reason:</label>
                <select name="reason" class="form-control input-sm">
                    <option value="">All</option>
                    @if ($reasons)
                        @foreach($reasons as $key => $item)
                            <option value="{{$key}}" @if($key == $reason) selected @endif>{{$item}}</option>
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

            @if($keyword || $status || $reason || $date_from || $date_to)
                <div class="input-group">
                    <a href="{{url(config('laraadmin.adminRoute') . "/meetups")}}" type="submit" class="btn btn-default btn-sm" style="margin-left: 20px;">Clear</a>
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
		</tr>
		</thead>
		<tbody>
			@if($values)
				@foreach($values as $value)
					<tr>
						@foreach( $listing_cols as $col )
							@if($col == 'user_id_inviting')
								<td><a class="black_link" href="{{url(config('laraadmin.adminRoute') . '/users/' . $value->user_id_inviting . '/edit')}}">{{$value->inviting_user}}</td>
							@elseif($col == 'user_id_invited')
								<td><a class="black_link" href="{{url(config('laraadmin.adminRoute') . '/users/' . $value->user_id_invited . '/edit')}}">{{$value->invited_user}}</td>
							@else
								<td>{{$value->$col}}</td>
							@endif
						@endforeach
					</tr>
				@endforeach
			@else
				<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty text-center">No records found.</td></tr>
			@endif
		</tbody>
		</table>
        @if($values)
            <ul class="pagination pagination-sm no-margin pull-right">
                @if($keyword || $status || $reason || $date_from || $date_to)
                    {{ $values->appends(['keyword' => $keyword, 'status' => $status, 'reason' => $reason, 'date_from' => $date_from, 'date_to' => $date_to])->links() }}
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
    #meetups-search-form {
        display: flex;
        flex-direction: row;
    }
    #meetups-search-form .dropdown-field-search{
        width: 150px;
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    #meetups-search-form .dropdown-field-search select{
        margin: 0 15px;
    }
    #meetups-search-form .field-search{
        width: 150px;
    }
    #meetups-search-form .date-search{
        display: flex;
        align-items: baseline;
    }
    #meetups-search-form .date-search input{
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
