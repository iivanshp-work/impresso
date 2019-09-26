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
	</div>
</div>



@endsection

@push('styles')
@endpush

@push('scripts')
<script>
$(function () {

});
</script>
@endpush
