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
			@if(!$statuses->count())
				<p>You have not written any journals yet.</p>
			@else
				@foreach($statuses as $status)
					<div class="media">
					    <a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
					        <img class="media-object" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
					    </a>
					    <div class="media-body">
					        <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
					        <p>{{ $status->body }}</p>
					        <ul class="list-inline">
					            <li>2 days ago</li>
					            <li><a href="#">Like</a></li>
					            <li>10 likes</li>
					        </ul>
					
					        <div class="media">
					            <a class="pull-left" href="#">
					                <img class="media-object" alt="" src="">
					            </a>
					            <div class="media-body">
					                <h5 class="media-heading"><a href="#">Billy</a></h5>
					                <p>Yes, it is lovely!</p>
					                <ul class="list-inline">
					                    <li>8 minutes ago.</li>
					                    <li><a href="#">Like</a></li>
					                    <li>4 likes</li>
					                </ul>
					            </div>
					        </div>
					
					        <form role="form" action="#" method="post">
					            <div class="form-group">
					                <textarea name="reply-1" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
					            </div>
					            <input type="submit" value="Reply" class="btn btn-default btn-sm">
					        </form>
					    </div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
@stop
