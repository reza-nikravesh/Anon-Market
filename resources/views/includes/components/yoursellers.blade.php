<div class="content-sidebar mt-15">
	<div class="notices"  >
		<span class="notices-header subtitle">Your vendors</span>
		<ul class="notices-list list-indent">
			@forelse($sellers as $seller)
			<li><a href="{{ route('seller', ['seller' => $seller->seller->username]) }}">{{ $seller->seller->username }}</a></li>
			@empty
			<li class="description" >You are not a fan of any vendors yet!</li>
			@endforelse
		</ul>
	</div>
</div>