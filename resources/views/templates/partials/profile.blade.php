<link href="{!! asset('css/profile.css') !!}">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

	<div class="row panel">
        <div class="col-md-8  col-xs-12">
			@if ($user->getNameOrUsername() !== 'Kevin Tokheim')
				<img class="media-object" alt="{{ $user->getNameOrUserName() }}" src="{{ $user->getAvatarUrl() }}">
			@else
           <img src="../images/kevin.jpg" class="img-thumbnail picture hidden-xs" />
			@endif
           <img src="../images/moutains.jpg" class="img-thumbnail visible-xs picture_mob" />
           <div class="header">
                <h2>{{ $user->getNameOrUsername() }}</h2>
                <h4>{{ $user->location }}</h4>
                @if ($user->getNameOrUsername() !== 'Kevin Tokheim')
					<span>Tell us about yourself</span>
                @else
					<span>I am a web developer based in Portland, OR, and I am passionate about coding, music, and traveling.</span>
				@endif
           </div>
        </div>
    </div>   
    

