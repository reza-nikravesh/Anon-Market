@extends('master.main')

@section('title', 'Sales')

@section('content')

<div class="content-master">
	<div class="h2 mb-15">Sales</div>
	<a href="{{ route('sales', ['status' => 'all']) }}" class="container">All <span class="nav-count">{{ $user->sales()->count() }}</span></a>
	<a href="{{ route('sales', ['status' => 'waiting']) }}" class="container">Waiting  <span class="nav-count">{{ $user->totalSales('waiting') }}</span></a>
	<a href="{{ route('sales', ['status' => 'accepted']) }}" class="container">Accepted  <span class="nav-count">{{ $user->totalSales('accepted') }}</span></a>
	<a href="{{ route('sales', ['status' => 'shipped']) }}" class="container">Shipped  <span class="nav-count">{{ $user->totalSales('shipped') }}</span></a>
	<a href="{{ route('sales', ['status' => 'delivered']) }}" class="container">Delivered  <span class="nav-count">{{ $user->totalSales('delivered') }}</span></a>
	<a href="{{ route('sales', ['status' => 'canceled']) }}" class="container">Canceled  <span class="nav-count">{{ $user->totalSales('canceled') }}</span></a>
	<a href="{{ route('sales', ['status' => 'disputed']) }}" class="container">Disputed  <span class="nav-count">{{ $user->totalSales('disputed') }}</span></a>
	<table class="zebra table-space mt-20">
		<thead>
			<tr>
				<th>Product</th>
				<th>Buyer</th>
				<th>Total</th>
				<th>Status</th>
				<th>UUID</th>
			</tr>
		</thead>
		<tbody>
			@forelse($sales as $sale)
				<tr>
					<td><a href="{{ route('product', ['product' => $sale->product->id ]) }}">{{ $sale->product->name }}</a></td>
					<td>{{ $sale->buyer->username }}</td>
					<td>@include('includes.components.displayprice', ['price' => $sale->total])</td>
					<td><strong>{{ $sale->status }}</strong></td>
					<td><a href="{{ route('order', ['order' => $sale->id]) }}">{{ $sale->id }}</a></td>
				</tr>
			@empty
				<tr>
					<td colspan="6">Hmm... Looks like you don't have any sales yet.</td>
				</tr>
			@endforelse
			<tr>
				<td colspan="6">{{ $sales->links('includes.components.pagination') }}</td>
			</tr>
		</tbody>
	</table>
</div>

@stop