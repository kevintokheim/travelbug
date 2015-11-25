<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" alt="{{ $user->getNameOrUserName() }}" src="{{ $user->getAvatarUrl() }}">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="#">{{ $user->getNameOrUsername() }}</a></h4>
    </div>
    @if ($user->location)
		<p>{{ $user->location }}</p>
    @endif
</div>
