@php

#Get the 5 most recent news
$notices = App\Models\Notice::latest()

@endphp

<div class="content-sidebar">
	<div class="notices">
		<span class="notices-header">Staff notifications</span>
		<ul class="notices-list">
			@foreach($notices as $notice)
			<li><a href="{{ route('notice', ['notice' => $notice->id]) }}">{{ $notice->title }}</a></li>
			@endforeach
		</ul>
		<div class="mt-15" style="padding-left:15px;font-size:smaller;">
			<a href="{{ route('noticediary') }}">See more notifications</a>
		</div>
	</div>
</div>