@extends('templates.default')

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<form role="form" action="{{ route('status.post') }}" method="post">
				
				<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
				
					<textarea placeholder="Tell us about your journey, {{ Auth::user()->getFirstNameOrUsername() }}." name="status" class="form-control" rows="2"></textarea>
					@if ($errors->has('status'))
						<span class="help-block">{{ $errors->first('status') }}</span>
					@endif
				</div>
				
				<button type="submit" class="btn btn-default">Update status</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
				
			</form>
			
			<div class="checkbox">
				
				<label>
					<input type="checkbox">Are you currently traveling?
				</label>
				
			</div>
			
			<form role="form" action="#" method="post">
				
				<div class="form-group">
					<textarea placeholder="Where are you?" name="location" class="form-control" rows="1"></textarea>
				</div>
					
			</form>
			
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-5">
			<!-- Timeline statuses and replies -->
		</div>
	</div>
@stop
