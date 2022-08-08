@extends('master.main')

@section('title', 'Orders')

@section('content')

<div class="flex-column  m-auto w-full">
    <div class="title text-primary mb-15">Orders</div>
    <div class="subtitle text-primary mb-15"><strong><i>Please click on your order UUID link and proceed with payment.
                Notify BlackBlade immediately after payment.</i> </strong></div>
    <div class="flex-row ">
        <a href="{{ route('orders', ['status' => 'all']) }}">All <span
                class="nav-count">{{ $user->orders->count() }}</span></a>
        <a href="{{ route('orders', ['status' => 'waiting']) }}">Waiting <span
                class="nav-count">{{ $user->totalOrders('waiting') }}</span></a>
        <a href="{{ route('orders', ['status' => 'accepted']) }}">Accepted <span
                class="nav-count">{{ $user->totalOrders('accepted') }}</span></a>
        <a href="{{ route('orders', ['status' => 'shipped']) }}">Shipped <span
                class="nav-count">{{ $user->totalOrders('shipped') }}</span></a>
        <a href="{{ route('orders', ['status' => 'delivered']) }}">Delivered <span
                class="nav-count">{{ $user->totalOrders('delivered') }}</span></a>
        <a href="{{ route('orders', ['status' => 'canceled']) }}">Canceled <span
                class="nav-count">{{ $user->totalOrders('canceled') }}</span></a>
        <a href="{{ route('orders', ['status' => 'disputed']) }}">Disputed <span
                class="nav-count">{{ $user->totalOrders('disputed') }}</span></a>

    </div>
    <div class="flex-row overflow-x-scroll">
        <table class="zebra table-space mt-20">
            <thead class="subtitle-sm text-secondary">
                <tr>
                    <th>Product</th>
                    <th>Vendor</th>
                    <th>Finalize early</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>UUID</th>
                </tr>
            </thead>
            <tbody class="description">
                @forelse($orders as $order)
                <tr>
                    <td><a
                            href="{{ route('product', ['product' => $order->product->id ]) }}">{{ $order->product->name }}</a>
                    </td>
                    <td><a
                            href="{{ route('seller', ['seller' => $order->seller->username]) }}">{{ $order->seller->username }}</a>
                    </td>
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
</div>

@stop