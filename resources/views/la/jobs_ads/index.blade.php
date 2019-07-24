@extends("la.layouts.app")

@section("contentheader_title", "Jobs ADs")
@section("contentheader_description", "Jobs ADs listing")
@section("section", "Jobs ADs")
@section("sub_section", "Listing")
@section("htmlheader_title", "Jobs ADs Listing")

@section("headerElems")
@la_access("Jobs_ADs", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Jobs AD</button>
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
			{!! Form::open(['action' => 'LA\Jobs_ADsController@index', 'method' => 'get',  'id' => 'jobs_ads-search-form']) !!}
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
					<a href="{{url(config('laraadmin.adminRoute') . "/jobs_ads")}}" type="submit" class="btn btn-default btn-sm" style="margin-left: 20px;">Clear</a>
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
						<td>@if($col == 'text'){{str_limit(strip_tags($value->$col), 50)}}@elseif ($col == $view_col){!!$value->$col!!}@else{{$value->$col}}@endif</td>
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

@la_access("Jobs_ADs", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Jobs AD</h4>
			</div>
			{!! Form::open(['action' => 'LA\Jobs_ADsController@store', 'id' => 'jobs_ad-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    {{--@la_form($module)--}}
					@la_input($module, 'title')
					<div class="form-group">
						<label for="text">Text :</label>
						<textarea class="form-control" data-ckeditor-preset="minimal" placeholder="Text" cols="30" rows="3" name="text" ></textarea>
					</div>
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
		#jobs_ads-search-form {
			display: flex;
			flex-direction: row;
		}
		#jobs_ads-search-form .dropdown-field-search{
			width: 150px;
			display: flex;
			flex-direction: row;
			align-items: center;
		}
		#jobs_ads-search-form .dropdown-field-search select{
			margin: 0 15px;
		}
		#jobs_ads-search-form .field-search{
			width: 150px;
		}
	</style>
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('la-assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
(function($){
	var index = 0;
	$.fn.ckeditor = function(){
		return this.each(function(){
			var This = $(this).addClass('ckeditor');
			if(!This.data('ckeditor')){
				if(!This.attr('id')) This.attr('id', 'ckeditor-'+index++);
				if(typeof CKEDITOR != 'undefined'){

					var config = $(this).data('ckeditor-config');
					var preset = config ? "custom" : $(this).data('ckeditor-preset');
					switch(preset){
						case 'custom':
							break;
						case 'minimal':
							config = {uiColor: '#FAFAFA',toolbar : [['Bold', 'Italic', 'Underline', 'Link']]};
							break;
						case 'minimal+link':
							config = {uiColor: '#FAFAFA',toolbar : [['Bold', 'Italic', 'Underline']]};
							break;
						default:
							config = {uiColor: '#FAFAFA',toolbar : [['Bold', 'Italic', 'Underline']]};
							config = {
								uiColor: '#FAFAFA'
							}
					}
					config.readOnly = $(this).attr('readonly');

					This.data('ckeditor', CKEDITOR.replace(this, config));
				}
			}
		});
	};
	$.fn.ckeditorUpdateElement = function(){
		return this.each(function(){
			var ckeditor = $(this).data('ckeditor');
			if(ckeditor) ckeditor.updateElement();
		});
	};
	$.fn.ckeditorDestroy = function(){
		return this.each(function(){
			var This = $(this), ckeditor = This.data('ckeditor');
			if(ckeditor){
				ckeditor.destroy();
				This.data('ckeditor', null);
			}
		});
	};
	$.fn.ckeditorRefresh = function(){
		return this.ckeditorDestroy().ckeditor();
	};
	CKEDITOR.editorConfig = function( config ) {
		config.language = 'fr';
		config.uiColor = '#AADC6E';
	};
})(jQuery);
$(function () {
	$("[name='text']").ckeditor();
	$("#jobs_ad-add-form").validate({
		
	});
});
</script>
@endpush
