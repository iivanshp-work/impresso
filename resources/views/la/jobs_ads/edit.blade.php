@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/jobs_ads') }}">Jobs AD</a> :
@endsection
@section("contentheader_description", $jobs_ad->$view_col)
@section("section", "Jobs ADs")
@section("section_url", url(config('laraadmin.adminRoute') . '/jobs_ads'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Jobs ADs Edit : ".$jobs_ad->$view_col)

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
				{!! Form::model($jobs_ad, ['route' => [config('laraadmin.adminRoute') . '.jobs_ads.update', $jobs_ad->id ], 'method'=>'PUT', 'id' => 'jobs_ad-edit-form']) !!}
					{{--@la_form($module)--}}

					@la_input($module, 'title')
					<div class="form-group">
						<label for="text">Text :</label>
						<textarea class="form-control" data-ckeditor-preset="minimal" placeholder="Text" cols="30" rows="3" name="text" >{!!$jobs_ad->text!!}</textarea>
					</div>
					@la_input($module, 'status')

                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jobs_ads') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

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
							config = {uiColor: '#FAFAFA',toolbar : [['Bold', 'Italic', 'Underline', 'Link']], enterMode: CKEDITOR.ENTER_BR,	shiftEnterMode: CKEDITOR.ENTER_BR};
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
	$("#jobs_ad-edit-form").validate({
		
	});
});
</script>
@endpush
