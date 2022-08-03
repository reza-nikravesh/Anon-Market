@extends('master.main')

@section('title', $seller->username.' Vendor')

@section('content')

<div class="featured-listings-sidebar">
<div class="h3 mb-20">Random listings</div>
@foreach($seller->randomListings() as $product)
	<div class="featured-product-sidebar">
		<a href="{{ route('product', ['product' => $product->id]) }}">
			<img src="{{ $product->featuredImage() }}" class="product-image" width="180px" height="135px">
			<div class="featured-product-title">{{ $product->name }}</div>
		</a>
		<span class="price-small"><small>from</small> {{ $product->from() }}</span>
	</div>
@endforeach
</div>
<div class="content-profile">
	@include('includes.flash.success')
	@include('includes.flash.error')
	<div class="h1 mb-10">{{ $seller->username }}</div>
	<div class="inblock">
		<img src="{{ $seller->avatar }}" width="114px" height="114px">
	</div>
	<div class="inblock container" style="vertical-align: top">
		Positive feedbacks: <strong>{{ $seller->totalFeedbacks('positive') }}</strong><br>
		Neutral feedbacks: <strong>{{ $seller->totalFeedbacks('neutral') }}</strong><br>
		Negative feedbacks: <strong>{{ $seller->totalFeedbacks('negative') }}</strong><br>
		<div class="mt-20">
			<strong>Fe enable(?): @if($seller->finalizeEarly()) &#10003; @else &#10005; @endif</strong>
		</div>
	</div>
	<br>
	<a href="{{ route('conversations', ['user' => $seller->username]) }}">send a message</a>
	<div class="container mt-40 mb-40">
		Was last seen: <strong>{{ $seller->lastLogin() }}</strong><br>
		Sales with <strong>{{ $seller->ratePositiveFeedbacks() }}</strong> positive feedback from a total of <strong>{{ $seller->totalFeedbacks() }}</strong> feedbacks, won <strong>{{ $seller->wonDisputes() }}</strong> disputes out of a total of <strong>{{ $seller->totalDisputes() }}</strong> disputes<br>
		Has <strong>{{ $seller->totalFans() }}</strong> fans - 
		<form action="{{ route('post.fan', ['seller' => $seller->username]) }}" method="post" class="inblock">
			@csrf
			<button class="btn-link footnote">{{ !auth()->user()->isFan($seller) ? 'Become a fan!' : 'Stop being a fan' }}</button>
		</form>
	</div>
	<div class="container mb-40">
		<div class="h3">Description</div>
		{!! Illuminate\Support\Str::markdown(strip_tags($seller->seller_description)) !!}
	</div>
	<div class="container mb-40">
		<div class="h3">Rules</div>
		{!! Illuminate\Support\Str::markdown(strip_tags($seller->seller_rules)) !!}
	</div>
	<div class="container mb-40">
		<div class="h3">PGP key</div>
		<pre>{{ $seller->pgp_key }}</pre>
	</div>
	<div class="h3 mt-40">Products</div>
	<table class="zebra mt-10" style="text-align: center; width: 760px">
		<thead>
			<th>Featured image</th>
			<th>Category</th>
			<th>Name</th>
			<th>From</th>
			<th>Ships to</th>
			<th>Ships from</th>
		</thead>
		<tbody>
			@forelse($products as $product)
			<tr>
				<td><img src="{{ $product->featuredImage() }}" height="32px" width="32px"></td>
				<td><a href="{{ route('category', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a></td>
				<td><a href="{{ route('product', ['product' => $product->id]) }}">{{ $product->name }}</a></td>
				<td>@include('includes.components.displayprice', ['price' => $product->from()])</td>
				<td>{{ $product->shipsTo() }}</td>
				<td>{{ $product->shipsFrom() }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="6">Humm... Looks like this vendor doesn't have any products.</td>
			</tr>
			@endforelse
			<tr>
				<td colspan="6">{{ $products->links('includes.components.pagination') }}</td>
			</tr>
		</tbody>
	</table>
	<div class="h3 mt-40">Customers reviews</div>
	<table class="zebra mt-10" style="text-align: center; width: 760px">
		<thead>
			<th>Rating</th>
			<th>Type</th>
			<th>User</th>
			<th>Review</th>
			<th>Freshness</th>
			<th>Product</th>
		</thead>
		<tbody>
			@forelse($feedbacks as $feedback)
			<tr>
				<td>{{ number_format($feedback->rating, 2) }} of 5</td>
				<td>{{ $feedback->type }}</td>
				<td>{{ $feedback->hiddenUser() }}</td>
				<td style="text-align: left">{{ $feedback->message }}</td>
				<td>{{ $feedback->freshness() }}</td>
				<td><a href="{{ route('product', ['product' => $feedback->product->id]) }}">view</a></td>
			</tr>
			@empty
			<tr>
				<td colspan="6">Humm... It looks like this Vendor has no reviews.</td>
			</tr>
			@endforelse
			<tr>
				<td colspan="6">{{ $feedbacks->links('includes.components.pagination') }}</td>
			</tr>
		</tbody>
	</table>
</div>

@stop