@extends('la.layouts.app')

@section('htmlheader_title')
	Job View
@endsection


@section('main-content')
<div id="page-content" class="profile2">

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/jobs') }}" data-toggle="tooltip" data-placement="right" title="Back to Jobs"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>General Info</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'job_title')
						@la_display($module, 'company_title')
						@la_display($module, 'short_description')
						@la_display($module, 'description')
						@la_display($module, 'location_title')
						@la_display($module, 'longitude')
						@la_display($module, 'latitude')
						<div class="form-group">
                            <label for="longitude" class="col-md-2">Status :</label>
                            <div class="col-md-10 fvalue">{!!$module->row->status ? "<div class='label label-success'>Active</div>" : "<div class='label label-danger'>Inactive</div>"!!}</div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>
@endsection
