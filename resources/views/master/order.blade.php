@extends('master.main')

@section('title', 'Order #'.$order->id)
@include('includes.flash.validation')
@include('includes.flash.success')
@section('content')

<div class="content-browsing m-auto w-full">
	<div class="title text-primary mb-15 w-100">Order - <a class="title" href="{{ route('product', ['product' => $order->product_id]) }}">{{ $order->product->name }}</a></div>
	<div class="align-self-center">
		<div class="avatar">
			<img src="{{ $order->buyer->avatar }}" height="96px" width="96px" class="product-image">
		</div>
		<div>
			@if(!$order->isBuyer())
			<a class="description" href="{{ route('conversations', ['user' => $order->buyer->username]) }}">send message</a>
			@endif
		</div>
	</div>
	<div class=" overflow-x-scroll">
		<div class="subtitle text-primary">Buyer statistics - {{ $order->buyer->username }}</div>
		@include('includes.components.buyerstats', ['user' => $user])
	</div>
	<div class="overflow-x-scroll">
		<div class="subtitle text-primary">Order details</div>
		<div class="flex-row ">
			<table class="zebra">
				<tr>
					<th class="subtitle-sm text-secondary" colspan="2">UUID: {{ $order->id }}</th>
				</tr>
				<tr class="description">
					<td>quantity</td>
					<td>{{ $order->quantity }}</td>
				</tr>
				<tr class="description">
					<td>total price</td>
					<td>{{ \App\Tools\Converter::currencyConverter($order->total, auth()->user()->currency) }} {{ auth()->user()->currency }}</td>
				</tr>
				<tr class="description">
					<td>delivery method</td>
					<td>{{ $order->delivery_method }}</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="overflow-x-scroll">
		<div class="subtitle text-primary">Order cycle</div>
		<div class="flex-row ">
			<table class="zebra">
				<tr>
					<thead class="subtitle-sm text-secondary">
						<th>payment wallet
							@if($order->isBuyer())
							<div class="info-wrapper float-right">
								<div class="info-folder">
									<div class="info-icon">?</div>
									<div class="info-message">Send the amount informed to this address.</div>
								</div>
							</div>
							@endif
						</th>

						<th>Amount</th>
					</thead>
				</tr>
				<tbody class="description">
					<tr>
						<td><input type="text" value="{{ $order->escrow_monero_wallet }}" style="font-family: Courier; font-size: 90%; background-color: #fff; color: #000; font-weight: bold; width: 261px" disabled></td>
						<td class="text-center">XMR {{ $toPay }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col mt-40">
		<div>
			<div class="input-container">
				<div class="subtitle text-primary"> Delivery address</div>
				<textarea disabled>{{ $order->address }}</textarea>
			</div>
			<div class="flex-row subtitle-sm">
				<div class="box  mt-10 ">
					<div class="flex-row ">
						<span class=" @if($order->waiting()) active @endif">Waiting</span> ???
						<span class=" @if($order->accepted()) active @endif">Shipped</span> ???
						<span class=" @if($order->delivered()) active @endif">Delivered</span>
					</div>
				</div>
				<div class="container   mt-10">
					<span class=" @if($order->canceled()) active @endif">Canceled</span>
				</div>
				<div class="container   mt-10">
					<span class=" @if($order->disputed()) active @endif">In dispute</span>
				</div>

			</div>
			<div class="description container container-md  mt-10">
				<div class="subtitle text-primary mb-10">Note</div>
				@if($order->waiting())
				@if($order->isBuyer())
				<span>Pay for the purchase and wait for the vendor to proceed. If the vendor cancels your order, your funds will be returned. <strong>Orders with the status "waiting" are automatically canceled within two days.</strong></span>
				@else
				<span>You can only take further action with the order after the buyer sends the money to the payment wallet. <strong>Orders with the status "waiting" are automatically canceled within two days.</strong></span>
				@endif
				<div class="actions mt-20">
					@if(!$order->isBuyer())
					<form action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'accepted']) }}" method="post" >
						@csrf
						<button type="submit">Accept order</button>
					</form>
					@endif
					<form class="mt-10" action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'canceled']) }}" method="post" >
						@csrf
						<button type="submit">Cancel order</button>
					</form>
				</div>
				@endif
				@if($order->accepted())
				@if($order->isBuyer())
				<span>Seller has accepted your order!</span>
				@else
				<span>Order marked as accept! Mark as shipped after the product is shipped.</span>
				@endif
				<div class="actions mt-20">
					@if(!$order->isBuyer())
					<form  action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'shipped']) }}" method="post" class="inblock">
						@csrf
						<button type="submit">Order dispatched</button>
					</form>
					@endif
					<form class="mt-10" action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'canceled']) }}" method="post" class="inblock">
						@csrf
						<button type="submit">Cancel order</button>
					</form>
					<form class="mt-10" action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'disputed']) }}" method="post" class="inblock">
						@csrf
						<button type="submit">start dispute</button>
					</form>
				</div>
				@endif
				@if($order->shipped())
				<span>The order has been marked as shipped! <strong>Purchases with the status "shipped" complete automatically within thirty days.</strong></span>
				<div class="actions mt-20">
					@if($order->isBuyer())
					<form action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'delivered']) }}" method="post" class="inblock">
						@csrf
						<button type="submit">Order delivered</button>
					</form>
					@endif
					<form action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'disputed']) }}" method="post" class="inblock">
						@csrf
						<button type="submit">Start dispute</button>
					</form>
					@if($order->isBuyer() && $order->seller->finalizeEarly())
					<form action="{{ route('post.finalizearly', ['order' => $order->id]) }}" method="post" class="inblock float-right">
						@csrf
						<button type="submit">Finalize early</button>
					</form>
					@endif
				</div>
				@endif
				@if($order->delivered())
				@if($order->isBuyer())
				<span>You marked the order as delivered and the funds will be released to the vendor. In case of problems with the received product, please start a dispute.</span>
				<div class="actions mt-20">
					<form action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'disputed']) }}" method="post" class="inblock">
						@csrf
						<button type="submit">Start dispute</button>
					</form>
				</div>
				<form action="{{ route('post.feedback', ['feedback' => $feedback->id]) }}" method="post" class="mt-20 text-primary">
					<div class="h3 mb-10">My feedback</div>
					@csrf
					<div class="form-group ">
						<div class="input-container">
							<label for="rating">Rating</label>
							<input type="text" id="rating" name="rating" placeholder="from 1 to 5" @if(!is_null($feedback)) value="{{ $feedback->rating }}" @endif>
						</div>
					</div>
					<div class="form-group ">
						<div class="input-container">
							<label for="type">Type</label>
							<select id="type" name="type" class="dropdown-wrapper">
								@foreach(config('general.feedback_type') as $type)
								<option value="{{ $type }}" @if(!is_null($feedback) and $feedback->type == $type) selected @endif>{{ $type }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="input-container">
							<label for="feedback">Feedback</label>
							<textarea id="feedback" name="feedback" cols="50" rows="20">@if(!is_null($feedback)) {{ $feedback->message }} @endif</textarea>
						</div>
					</div>
					<button type="submit">Submit feedback</button>
				</form>
				@else
				<span>Order marked as delivered! Funds will be released shortly. Money will drop after three confirmations.</span>
				<div class="actions mt-20">
					<form action="{{ route('post.changeorderstatus', ['order' => $order->id, 'status' => 'disputed']) }}" method="post" class="inblock">
						@csrf
						<button type="submit">Start dispute</button>
					</form>
				</div>
				@endif
				@endif
				@if($order->disputed())
				<span>A dispute has started! Use the field below to send messages.</span>
				@if($order->dispute->winner_id != null)
				<span class="flashdata flashdata-success mt-10 mb-10">Winner of the dispute: {{ $order->dispute->winner->username }}</span>
				@else
				<span class="flashdata flashdata-error mt-10 mb-10">Winner of the dispute: none</span>
				@endif
				@staff
				<form action="{{ route('post.resolvedispute', ['dispute' => $order->dispute->id]) }}" method="post" class="mb-15">
					@csrf
					<label id="winner" class="text-default">Winner:</label>
					<select id="winner" name="winner" class="dropdown-wrapper">
						<option value="">None</option>
						<option value="{{ $order->buyer->id}}" @if($order->dispute->winner_id == $order->buyer->id) selected @endif>{{ $order->buyer->username }} (buyer)</option>
						<option value="{{ $order->seller->id}}" @if($order->dispute->winner_id == $order->seller->id) selected @endif>{{ $order->seller->username }} (seller)</option>
					</select>
					<button type="submit">Mark</button>
				</form>
				@endif
				<form action="{{ route('post.createdisputemessage', ['dispute' => $order->dispute->id]) }}" method="post" class="text-primary">
					@csrf
					<div class="h3 mb-10">Create new message</div>
					<div class="form-group">
						<div class="label">
							<label for="message">Message</label>
						</div>
						<textarea id="message" name="message" cols="50" rows="20"></textarea>
					</div>
					<button type="submit">Submit</button>
				</form>
				<div class="messages">
					@foreach($messages as $message)
					<div class="container mt-10" style="width: 485px">
						{{ $message->decryptMessage() }}
						<div class="mt-20">
							<small>{{ $message->user->username }} - {{ $message->creationDate() }}</small>
						</div>
					</div>
					@endforeach
				</div>
				{{ $messages->links('includes.components.pagination') }}
				@endif
				@if($order->canceled())
				@if($order->isBuyer())
				<span>Order canceled! Your funds will be returned shortly.</span>
				@else
				<span>Order canceled!</span>
				@endif
				@endif
			</div>
		</div>

	</div>
</div>

@stop