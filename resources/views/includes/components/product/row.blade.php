<div class="product" >
	<a href="{{ route('product', ['product' => $product->id]) }}" class="float-left">
		<img src="{{ $product->featuredImage() }}" alt="No image" class="product-image-card" width="130px" height="135px">
	</a>
	
	<div class="product-infos">
		<a href="{{ route('product', ['product' => $product->id]) }}" class="subtitle text-secondary ">{{ $product->name }}</a>
		<div class="product-description description mt-15">
			<span class="text-secondary">Seller <a href="{{ route('seller', ['seller' => $product->seller->username]) }}">{{ $product->seller->username }}({{ $product->seller->totalFeedbacks() }})</a></span><br>
			<span class="text-secondary">Ships from: {{ $product->shipsFrom() }}</span></br>
			<span class="text-secondary">Ships to: {{ $product->shipsTo() }}</span>
		</div>
	</div>
	<div class="product-price">
		<div class="price-big"><small>from</small> @include('includes.components.displayprice', ['price' => $product->from()])</div>
		<form action="{{ route('post.favorites', ['product' => $product->id]) }}" method="post">
			@csrf
			<button class="bg-default mt-10" >{{ auth()->user()->isFavorite($product) ? 'remove' : 'add' }} to favorite</button>
		</form>
	</div>
</div>