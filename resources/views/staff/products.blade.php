@extends('master.main')

@section('title', 'Staff products')

@include('includes.flash.success')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile">
	<div class="subtitle text-primary">All products ({{ $totalProducts }})</div>
	<div class="mt-10">
		<form action="{{ route('staff.products', ['product' => $productId, 'seller' => $sellerUsername]) }}">
			<div class="input-container w-50" >
				<label for="product_id">Product id</label>
				<input type="text" id="product_id" name="product_id" value="{{ $productId }}">
			</div>
			<div class="input-container w-50">
				<label for="seller_username">Seller</label>
				<input type="text" id="seller_username" name="seller_username" value="{{ $sellerUsername }}">
			</div>
			<div class="mt-10">
				<button type="submit">Filter</button>
			</div>
		</form>
	</div>
	<div class="flex-row overflow-x-scroll">
		<table class="zebra mt-10" >
		<thead class="subtitle-sm text-secondary">
			<th>Featured image</th>
			<th>Category</th>
			<th>Product</th>
			<th>From</th>
			<th>Ships to</th>
			<th>Ships from</th>
			<th>Seller</th>
			<th>#</th>
		</thead>
		<tbody>
			@forelse($products as $product)
			<tr class="description">
				<td><img src="{{ $product->featuredImage() }}" height="32px" width="32px"></td>
				<td><a href="{{ route('category', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a></td>
				<td><a href="{{ route('product', ['product' => $product->id]) }}">{{ $product->name }}</a></td>
				<td>@include('includes.components.displayprice', ['price' => $product->from()])</td>
				<td>{{ $product->shipsTo() }}</td>
				<td>{{ $product->shipsFrom() }}</td>
				<td>{{ $product->seller->username }}</td>
				<td>
					<div class=" mb-10">
						<form action="{{ route('put.staff.featuredproduct', ['product' => $product->id]) }}" method="post">
							@csrf
							@method('PUT')
							<button type="submit">@if($product->featured) remove @endif highlight</button>
						</form>
					</div>
					<div class=" mb-10">
						<button><a href="{{ route('images', ['section' => 'edit', 'product' => $product->id]) }}" >edit</a></button>
					</div>
					<div >
						<form action="{{ route('post.deleteproduct', ['product' => $product->id]) }}" method="post">
							@csrf
							<button type="submit" class="text-error">delete</button>
						</form>
					</div>
				</td>
			</tr>
			@empty
			<tr class="description">
				<td  colspan="8">It looks like there are no products!</td>
			</tr>
			@endforelse
			<tr class="description">
				<td colspan="8">{{ $products->appends($filters)->links('includes.components.pagination') }}</td>
			</tr>
		</tbody>
	</table>
	</div>
	
</div>

@stop