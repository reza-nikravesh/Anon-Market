@extends('master.main')

@section('title', 'Staff disputes')

@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile">
	<div class="title text-primary">All disputes ({{ $disputes->count() }})</div>
	<div class="flex-row overflow-x-scroll">
		<table class="zebra mt-10" >
		<thead>
			<tr class="subtitle-sm text-secondary">
				<th>Product</th>
				<th>Seller</th>
				<th>Buyer</th>
				<th>Winner</th>
				<th>UUID</th>
			</tr>
		</thead>
		<tbody class="description">
			@forelse($disputes as $dispute)
			<tr>
				<td><a href="{{ route('product', ['product' => $dispute->product->id]) }}">{{ $dispute->product->name }}</a></td>
				<td><a href="{{ route('seller', ['seller' => $dispute->seller->username]) }}">{{ $dispute->seller->username }}</a></td>
				<td>{{ $dispute->buyer->username }}</td>
				<td>{{ $dispute->winner != null ? $dispute->winner->username : 'undefined' }}</td>
				<td><a href="{{ route('order', ['order' => $dispute->order->id]) }}">{{ $dispute->order->id }}</a></td>
			</tr>
			@empty
			<tr>
				<td colspan="5">The market still has no disputes!</td>
			</tr>
			@endforelse
			<tr>
				<td colspan="5">{{ $disputes->links('includes.components.pagination') }}</td>
			</tr>
		</tbody>
	</table>
	</div>
	
</div>

@stop