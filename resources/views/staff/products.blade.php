@extends('master.main')

@section('title', 'Staff products')

@include('includes.flash.success')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile container-md">
	<div class="subtitle text-primary">All products ({{ $totalProducts }})</div>
	<div class="mt-10">
		<form action="{{ route('staff.products', ['product' => $productId, 'seller' => $sellerUsername]) }}">
			<div class="input-container w-50">
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
		<table class="zebra mt-10">
			<thead class="subtitle-sm text-secondary">
				<th>
					<div class="flex-row items-center">
						<span>Featured image</span>
						<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
							<path d="M447.1 32h-384C28.64 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM111.1 96c26.51 0 48 21.49 48 48S138.5 192 111.1 192s-48-21.49-48-48S85.48 96 111.1 96zM446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z" />
						</svg>
					</div>
				</th>
				<th>
					<div class="flex-row items-center">
						<span>Category</span>
						<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM384 96H256V224H384V96zM384 288H256V416H384V288zM192 224V96H64V224H192zM64 416H192V288H64V416z" />
						</svg>
					</div>
				</th>
				<th>
					<div class="flex-row items-center">
						<span>Product</span>
						<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M50.73 58.53C58.86 42.27 75.48 32 93.67 32H208V160H0L50.73 58.53zM240 160V32H354.3C372.5 32 389.1 42.27 397.3 58.53L448 160H240zM448 416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V192H448V416z" />
						</svg>
					</div>
				</th>
				<th>
					<div class="flex-row items-center">
						<span>From</span>
						<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
							<path d="M160 0C177.7 0 192 14.33 192 32V67.68C193.6 67.89 195.1 68.12 196.7 68.35C207.3 69.93 238.9 75.02 251.9 78.31C268.1 82.65 279.4 100.1 275 117.2C270.7 134.3 253.3 144.7 236.1 140.4C226.8 137.1 198.5 133.3 187.3 131.7C155.2 126.9 127.7 129.3 108.8 136.5C90.52 143.5 82.93 153.4 80.92 164.5C78.98 175.2 80.45 181.3 82.21 185.1C84.1 189.1 87.79 193.6 95.14 198.5C111.4 209.2 136.2 216.4 168.4 225.1L171.2 225.9C199.6 233.6 234.4 243.1 260.2 260.2C274.3 269.6 287.6 282.3 295.8 299.9C304.1 317.7 305.9 337.7 302.1 358.1C295.1 397 268.1 422.4 236.4 435.6C222.8 441.2 207.8 444.8 192 446.6V480C192 497.7 177.7 512 160 512C142.3 512 128 497.7 128 480V445.1C127.6 445.1 127.1 444.1 126.7 444.9L126.5 444.9C102.2 441.1 62.07 430.6 35 418.6C18.85 411.4 11.58 392.5 18.76 376.3C25.94 360.2 44.85 352.9 60.1 360.1C81.9 369.4 116.3 378.5 136.2 381.6C168.2 386.4 194.5 383.6 212.3 376.4C229.2 369.5 236.9 359.5 239.1 347.5C241 336.8 239.6 330.7 237.8 326.9C235.9 322.9 232.2 318.4 224.9 313.5C208.6 302.8 183.8 295.6 151.6 286.9L148.8 286.1C120.4 278.4 85.58 268.9 59.76 251.8C45.65 242.4 32.43 229.7 24.22 212.1C15.89 194.3 14.08 174.3 17.95 153C25.03 114.1 53.05 89.29 85.96 76.73C98.98 71.76 113.1 68.49 128 66.73V32C128 14.33 142.3 0 160 0V0z" />
						</svg>
					</div>
				</th>
				<th>
					<div class="flex-row items-center">
						<span>Ships to</span>

						<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M285.6 444.1C279.8 458.3 264.8 466.3 249.8 463.4C234.8 460.4 223.1 447.3 223.1 432V256H47.1C32.71 256 19.55 245.2 16.6 230.2C13.65 215.2 21.73 200.2 35.88 194.4L387.9 50.38C399.8 45.5 413.5 48.26 422.6 57.37C431.7 66.49 434.5 80.19 429.6 92.12L285.6 444.1z" />
						</svg>
					</div>
				</th>
				<th>
					<div class="flex-row items-center">
						<span>Ships from</span>
						<svg class='ic-sm' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
							<path d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
						</svg>
					</div>
				</th>
				<th>
					<div class="flex-row items-center">
						<span>Seller</span>

						<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
						</svg>
					</div>
				</th>
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
							<button><a href="{{ route('images', ['section' => 'edit', 'product' => $product->id]) }}">edit</a></button>
						</div>
						<div>
							<form action="{{ route('post.deleteproduct', ['product' => $product->id]) }}" method="post">
								@csrf
								<button type="submit" class="text-error">delete</button>
							</form>
						</div>
					</td>
				</tr>
				@empty
				<tr class="description">
					<td colspan="8">It looks like there are no products!</td>
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