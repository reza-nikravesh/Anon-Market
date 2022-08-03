<div class="product" style="min-width:50%;max-width:100%;width:stretch;">
	<a href="{{ route('product', ['product' => $product->id]) }}" class="float-left">
		<img src="{{ $product->featuredImage() }}" alt="No image" class="product-image" width="130px" height="135px">
	</a>
	<div class="product-price">
		<div class="price-big"><small>from</small> @include('includes.components.displayprice', ['price' => $product->from()])</div>
		<form action="{{ route('post.favorites', ['product' => $product->id]) }}" method="post">
			@csrf
			<button class="btn-link">{{ auth()->user()->isFavorite($product) ? 'remove' : 'add' }} to favorite</button>
		</form>
	</div>
	<div class="product-infos">
		<a href="{{ route('product', ['product' => $product->id]) }}" class="h2">{{ $product->name }}</a>
		<div class="product-description mt-15">
			<span style="color:black;">Seller <a href="{{ route('seller', ['seller' => $product->seller->username]) }}">{{ $product->seller->username }}({{ $product->seller->totalFeedbacks() }})</a></span><br>
			<span style="color:black;">Ships from: {{ $product->shipsFrom() }}</span></br>
			<span style="color:black;">Ships to: {{ $product->shipsTo() }}</span>
		</div>
	</div>
</div>