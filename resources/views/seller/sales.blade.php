@extends('master.main')

@section('title', 'Sales')

@section('content')

<div class="flex-column w-full m-auto">
    <div class="title text-primary mb-15">Sales</div>
    <div class="flex-row ">
        <a href="{{ route('sales', ['status' => 'all']) }}">All <span>{{ $user->sales()->count() }}</span></a>
        <a href="{{ route('sales', ['status' => 'waiting']) }}">Waiting
            <span>{{ $user->totalSales('waiting') }}</span></a>
        <a href="{{ route('sales', ['status' => 'accepted']) }}">Accepted
            <span>{{ $user->totalSales('accepted') }}</span></a>
        <a href="{{ route('sales', ['status' => 'shipped']) }}">Shipped
            <span>{{ $user->totalSales('shipped') }}</span></a>
        <a href="{{ route('sales', ['status' => 'delivered']) }}">Delivered
            <span>{{ $user->totalSales('delivered') }}</span></a>
        <a href="{{ route('sales', ['status' => 'canceled']) }}">Canceled
            <span>{{ $user->totalSales('canceled') }}</span></a>
        <a href="{{ route('sales', ['status' => 'disputed']) }}">Disputed
            <span>{{ $user->totalSales('disputed') }}</span></a>

    </div>
    <div class="flex-row overflow-x-scroll">
		<table class="zebra table-space mt-20">
        <thead>
            <tr class="subtitle-sm text-secondary">
                <th>Product</th>
                <th>Buyer</th>
                <th>Total</th>
                <th>Status</th>
                <th>UUID</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
            <tr class="description">
                <td><a href="{{ route('product', ['product' => $sale->product->id ]) }}">{{ $sale->product->name }}</a>
                </td>
                <td>{{ $sale->buyer->username }}</td>
                <td>@include('includes.components.displayprice', ['price' => $sale->total])</td>
                <td><strong>{{ $sale->status }}</strong></td>
                <td><a href="{{ route('order', ['order' => $sale->id]) }}">{{ $sale->id }}</a></td>
            </tr>
            @empty
            <tr class="description">
                <td colspan="6">Hmm... Looks like you don't have any sales yet.</td>
            </tr>
            @endforelse
            <tr>
                <td colspan="6">{{ $sales->links('includes.components.pagination') }}</td>
            </tr>
        </tbody>
    </table>
	</div>
    
</div>

@stop