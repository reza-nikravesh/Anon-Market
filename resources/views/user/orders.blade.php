@extends('master.main')

@section('title', 'Orders')

@section('content')

<div class="content-master">
	<div class="h2 mb-15">Orders</div>
	<div class="h2 mb-15"><strong><i>Please click on your order UUID link and proceed with payment. Notify BlackBlade immediately after payment.</i> </strong></div>
	<a href="{{ route('orders', ['status' => 'all']) }}" class="container">All <span class="nav-count">{{ $user->orders->count() }}</span></a>
	<a href="{{ route('orders', ['status' => 'waiting']) }}" class="container">Waiting  <span class="nav-count">{{ $user->totalOrders('waiting') }}</span></a>
	<a href="{{ route('orders', ['status' => 'accepted']) }}" class="container">Accepted  <span class="nav-count">{{ $user->totalOrders('accepted') }}</span></a>
	<a href="{{ route('orders', ['status' => 'shipped']) }}" class="container">Shipped  <span class="nav-count">{{ $user->totalOrders('shipped') }}</span></a>
	<a href="{{ route('orders', ['status' => 'delivered']) }}" class="container">Delivered  <span class="nav-count">{{ $user->totalOrders('delivered') }}</span></a>
	<a href="{{ route('orders', ['status' => 'canceled']) }}" class="container">Canceled  <span class="nav-count">{{ $user->totalOrders('canceled') }}</span></a>
	<a href="{{ route('orders', ['status' => 'disputed']) }}" class="container">Disputed  <span class="nav-count">{{ $user->totalOrders('disputed') }}</span></a>
	<table class="zebra table-space mt-20">
		<thead>
			<tr>
				<th>Product</th>
				<th>Vendor</th>
				<th>Finalize early</th>
				<th>Total</th>
				<th>Status</th>
				<th>UUID</th>
			</tr>
		</thead>
		<tbody>
			@forelse($orders as $order)
				<tr>
					<td><a href="{{ route('product', ['product' => $order->product->id ]) }}">{{ $order->product->name }}</a></td>
					<td><a href="{{ route('seller', ['seller' => $order->seller->username]) }}">{{ $order->seller->username }}</a></td>
					<td>{{ $order->seller->fe == true ? 'Yes' : 'No' }}</td>
					<td>@include('includes.components.displayprice', ['price' => $order->total])</td>
					<td><strong>{{ $order->status }}</strong></td>
					<td><a href="{{ route('order', ['order' => $order->id]) }}">{{ $order->id }}</a></td>
				</tr>
			@empty
				<tr>
					<td colspan="7">Hmm... Looks like you don't have any orders yet.</td>
				</tr>
			@endforelse
				<tr>
					<td colspan="7">{{ $orders->links('includes.components.pagination') }}</td>
				</tr>
		</tbody>
	</table>
</div>

@stop