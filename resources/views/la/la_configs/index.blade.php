@extends("la.layouts.app")

@section("contentheader_title", "Configuration")
@section("contentheader_description", "")
@section("section", "Configuration")
@section("sub_section", "")
@section("htmlheader_title", "Configuration")

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
<form action="{{route(config('laraadmin.adminRoute').'.la_configs.store')}}" method="POST">
	<!-- general form elements disabled -->
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">GUI Settings</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			{{ csrf_field() }}
			<!-- text input -->
			<div class="form-group">
				<label>Sitename</label>
				<input type="text" class="form-control" placeholder="Sitename" name="sitename" value="{{$configs->sitename}}">
			</div>
			<div class="form-group">
				<label>Sitename First Word</label>
				<input type="text" class="form-control" placeholder="Sitename First Word" name="sitename_part1" value="{{$configs->sitename_part1}}">
			</div>
			<div class="form-group">
				<label>Sitename Second Word</label>
				<input type="text" class="form-control" placeholder="Sitename Second Word" name="sitename_part2" value="{{$configs->sitename_part2}}">
			</div>
			<div class="form-group">
				<label>Sitename Short (2/3 Characters)</label>
				<input type="text" class="form-control" placeholder="Short" maxlength="2" name="sitename_short" value="{{$configs->sitename_short}}">
			</div>
			<div class="form-group">
				<label>Site Description</label>
				<input type="text" class="form-control" placeholder="Description in 140 Characters" maxlength="140" name="site_description" value="{{$configs->site_description}}">
			</div>
			<!-- select -->
			<div class="form-group">
				<label>Skin Color</label>
				<select class="form-control" name="skin">
					@foreach($skins as $name=>$property)
						<option value="{{ $property }}" @if($configs->skin == $property) selected @endif>{{ $name }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>Layout</label>
				<select class="form-control" name="layout">
					@foreach($layouts as $name=>$property)
						<option value="{{ $property }}" @if($configs->layout == $property) selected @endif>{{ $name }}</option>
					@endforeach
				</select>
			</div>

            {{--
			<div class="form-group">
				<label>Default Email Address</label>
				<input type="text" class="form-control" placeholder="To send emails to others via SMTP" maxlength="100" name="default_email" value="{{$configs->default_email}}">
			</div>
            --}}

			<div class="form-group">
				<label>Validation Amount(in XIMS)</label>
				<input type="text" class="form-control" placeholder="Validation amount(XIMS)" maxlength="100" name="validation_value" value="{{$configs->validation_value}}">
			</div>

			<div class="form-group">
				<label>Initial Credits Amount(in XIMS)</label>
				<input type="text" class="form-control" placeholder="Initial Credits amount(XIMS)" maxlength="100" name="initial_credits_amount" value="{{$configs->initial_credits_amount}}">
			</div>

			<div class="form-group">
				<label>Meetup Invite - Credits Amount(in XIMS)</label>
				<input type="text" class="form-control" placeholder="Meetup Invite - Credits Amount(XIMS)" maxlength="100" name="invite_xims_amount" value="{{$configs->invite_xims_amount}}">
			</div>

			<div class="form-group">
				<label>Meetup Accept Invite - Credits Amount(in XIMS)</label>
				<input type="text" class="form-control" placeholder="Meetup Accept Invite - Credits Amount(XIMS)" maxlength="100" name="accepted_invite_xims_amount" value="{{$configs->accepted_invite_xims_amount}}">
			</div>

			<div class="form-group">
				<label>Feeds radius(KM)</label>
				<input type="text" class="form-control" placeholder="Feeds radius" maxlength="100" name="professionals_radius" value="{{$configs->professionals_radius}}">
			</div>

            <div class="form-group">
                <label>New Jobs notification radius(KM)</label>
                <input type="text" class="form-control" placeholder="New Jobs notification radius" maxlength="100" name="new_jobs_radius" value="{{$configs->new_jobs_radius}}">
            </div>

			<div class="form-group">
				<label>Daily Credits Amount(XIMS)</label>
				<input type="text" class="form-control" placeholder="Daily Credits Amount(XIMS)" maxlength="100" name="daily_xims_amount" value="{{$configs->daily_xims_amount}}">
			</div>

			<div class="form-group">
				<label>Referral Inviting User Amount(XIMS)</label>
				<input type="text" class="form-control" placeholder="Referral Inviting User Amount(XIMS)" maxlength="100" name="referral_inviting_xims_amount" value="{{$configs->referral_inviting_xims_amount}}">
			</div>

			<div class="form-group">
				<label>Referral Invited User Amount(XIMS)</label>
				<input type="text" class="form-control" placeholder="Referral Invited User Amount(XIMS)" maxlength="100" name="referral_invited_xims_amount" value="{{$configs->referral_invited_xims_amount}}">
			</div>


		</div><!-- /.box-body -->
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Save</button>
		</div><!-- /.box-footer -->
	</div><!-- /.box -->
</form>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>

@endpush
