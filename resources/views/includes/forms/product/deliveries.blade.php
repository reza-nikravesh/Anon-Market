@extends('product')

@section('product-form')

<div class="subtitle text-primary mt-10">Product delivery methods</div>
<div class="flex-row overflow-x-scroll">
	<table class="zebra table-space">
	<thead class="subtitle-sm text-secondary">
		<tr>
			<th>name</th>
			<th>number of days</th>
			<th>price(in USD)</th>
			<th>preview</th>
			<th>#</th>
		</tr>
	</thead>
	<tbody class="description">
		@if($section == 'edit')
			@forelse($product->deliveries as $delivery)
			<tr>
				<td>{{ $delivery->name }}</td>
				<td>{{ $delivery->days }} days</td>
				<td>{{ $delivery->price }}</td>
				<td>{{ $delivery->name }} - {{ $delivery->days }} day(s) - {{ $delivery->price }}</td>
				<td>
					<form action="{{ route('post.deletedelivery', ['section' => $section, 'delivery' => $delivery->id, 'product' => $product->id]) }}" method="post">
						@csrf
						<button class="mt-10 mb-10" type="submit" class="text-danger">delete</button>
					</form>
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="5">The product has no delivery methods!</td>
			</tr>
			@endforelse
		@else
			@forelse($deliveries as $delivery)
			<tr>
				<td>{{ $delivery['name'] }}</td>
				<td>{{ $delivery['days'] }}</td>
				<td>{{ $delivery['price'] }}</td>
				<td>{{ $delivery['name'] }} - {{ $delivery['days'] }} day(s) - {{ $delivery['price'] }}</td>
				<td>
					<form action="{{ route('post.deletedelivery', ['section' => 'add', 'delivery' => $delivery['uuid']]) }}" method="post">
						@csrf
						<button type="submit" class="text-danger">delete</button>
					</form>
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="5">The product has no delivery methods!</td>
			</tr>
			@endforelse
		@endif
	</tbody>
</table>	
	</div>

<div class="container mt-20">
	<form action="{{ $section == 'edit' ? route('post.delivery', ['section' => $section, 'product' => $product->id]) : route('post.delivery', ['section' => 'add']) }}" method="post">
		@csrf
		<div class="form-group">
			<div class="input-container">
					<label for="name">Name</label>
			<input type="text" id="name" name="name" placeholder="ex. world wide" maxlength="10">
			
			</div>@error('name')
			<div class="error">
				<span class="text-danger mt-10 description">{{ $errors->first('name') }}</span>
			</div>
			@enderror
		</div>
		<div class="form-group">
			<div class="input-container">
					<label for="days">Days</label>
			<input type="text" id="days" name="days" placeholder="max 30 days" maxlength="2">
			
			</div>@error('days')
			<div class="error">
				<span class="text-danger mt-10 description">{{ $errors->first('days') }}</span>
			</div>
			@enderror
		</div>
		<div class="form-group">
			<div class="input-container">
					<label for="price">Price</label>
			<input type="text" id="price" name="price" placeholder="max $999.999" maxlength="6">
			
			</div>@error('price')
			<div class="error">
				<span class="text-danger mt-10 description">{{ $errors->first('price') }}</span>
			</div>
			@enderror
		</div>
		<button class="mt-10" type="submit">Add delivery method</button>
	</form>
</div>
<div class="flex-row">
<a href="{{ $section == 'edit' ? route('offers', ['section' => $section, 'product' => $product->id]) : route('offers', ['section' => 'add']) }}" class="h3">back</a>
<a href="{{ $section == 'edit' ? route('informations', ['section' => $section, 'product' => $product->id]) : route('informations', ['section' => 'add']) }}" class="h3 float-right">next step</a>

</div>
@stop