@extends('master.main')

@section('title', 'Staff disputes')

@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile container-md">
	<div class="title text-primary">All disputes ({{ $disputes->count() }})</div>
	<div class="flex-row overflow-x-scroll">
		<table class="zebra mt-10">
			<thead>
				<tr class="subtitle-sm text-secondary">
					<th>
						<div class="flex-row items-center"><span> Product</span>
							<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path d="M50.73 58.53C58.86 42.27 75.48 32 93.67 32H208V160H0L50.73 58.53zM240 160V32H354.3C372.5 32 389.1 42.27 397.3 58.53L448 160H240zM448 416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V192H448V416z" />
							</svg>
						</div>
					</th>
					<th>
						<div class="flex-row items-center"><span> Seller</span>
							<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
							</svg>
						</div>
					</th>
					<th>
						<div class="flex-row items-center"><span> Buyer</span>
							<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
							</svg>
						</div>
					</th>
					<th>
						<div class="flex-row items-center"><span> Winner</span>
							<svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
								<path d="M572.1 82.38C569.5 71.59 559.8 64 548.7 64h-100.8c.2422-12.45 .1078-23.7-.1559-33.02C447.3 13.63 433.2 0 415.8 0H160.2C142.8 0 128.7 13.63 128.2 30.98C127.1 40.3 127.8 51.55 128.1 64H27.26C16.16 64 6.537 71.59 3.912 82.38C3.1 85.78-15.71 167.2 37.07 245.9c37.44 55.82 100.6 95.03 187.5 117.4c18.7 4.805 31.41 22.06 31.41 41.37C256 428.5 236.5 448 212.6 448H208c-26.51 0-47.99 21.49-47.99 48c0 8.836 7.163 16 15.1 16h223.1c8.836 0 15.1-7.164 15.1-16c0-26.51-21.48-48-47.99-48h-4.644c-23.86 0-43.36-19.5-43.36-43.35c0-19.31 12.71-36.57 31.41-41.37c86.96-22.34 150.1-61.55 187.5-117.4C591.7 167.2 572.9 85.78 572.1 82.38zM77.41 219.8C49.47 178.6 47.01 135.7 48.38 112h80.39c5.359 59.62 20.35 131.1 57.67 189.1C137.4 281.6 100.9 254.4 77.41 219.8zM498.6 219.8c-23.44 34.6-59.94 61.75-109 81.22C426.9 243.1 441.9 171.6 447.2 112h80.39C528.1 135.7 526.5 178.7 498.6 219.8z" />
							</svg>
						</div>
					</th>
					<th>
						<span> UUID</span>

					</th>
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