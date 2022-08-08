@extends('master.main')

@section('title', "Shopping cart ($totalProducts)")
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

<div class="flex-column m-auto w-full">

    <div class="flex-row justify-space-between">
        <div class="title text-primary mb-20  ">Shopping cart ({{ $totalProducts }})</div>
        <form action="{{ route('post.clearcart') }}" method="post">
            @csrf
            <button>Clear cart</button>
        </form>
    </div>
    <div class="flex-row overflow-x-scroll">
		 <table class="zebra table-space">
        <thead>
            <tr class="subtitle-sm text-secondary">
                <th>Product</th>
                <th>Seller</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Delivery</th>
                <th>Sub-total</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="description">
                <td><a
                        href="{{ route('product', ['product' => $product['product_id'] ]) }}">{{ $product['product_name'] }}</a>
                </td>
                <td><a href="{{ route('seller', ['seller' => $product['seller'] ]) }}">{{ $product['seller'] }}</a></td>
                <td>{{ $product['quantity'] }}</td>
                <td>@include('includes.components.displayprice', ['price' => $product['price']])</td>
                <td>{{ $product['delivery_method'] }} - @include('includes.components.displayprice', ['price' =>
                    $product['delivery_price']])</td>
                <td>@include('includes.components.displayprice', ['price' => $product['total']])</td>
                <td>
                    <form action="{{ route('post.removetocart', ['product' => $product['product_id'] ]) }}"
                        method="post">
                        @csrf
                        <button type="submit" class="btn-link">Remove</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr class="description">
                <td colspan="7">Your shopping cart is empty!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
	</div>
   
    <div class="container mt-20 ">
        <div class="title text-primary">Total: @include('includes.components.displayprice', ['price' =>
            $totalPrice])</div>
        <div class="subtitle-sm text-primary mb-15">Approximately
            {{ \App\Tools\Converter::moneroConverter($totalPrice) }} XMR</div>
        <div class="info-wrapper">
            <div class="info-folder">
                <div class="info-icon">?</div>
                <div class="info-message">Your address will be encrypted with the sellers' PGP key, ensuring that only
                    they will have access to your information! See how we protect your identity in the <a
                        href="{{ config('general.wiki_link') }}" target="_blank"><strong>buyer's guide</strong></a>.
                </div>
            </div>
        </div>
        <form action="{{ route('post.checkout') }}" method="post">
            @csrf
            <div class="input-container">
                <label for="address">
                    <pre> Your name and address</pre>
                </label>
                <textarea id="address" name="address" cols="35" rows="10"></textarea>
            </div>
            @error('address')
            <small class="text-danger subtitle-sm mt-10">{{ $errors->first('address') }}</small>
            @enderror
            <div class="mt-10">
                <div class="input-container w-50"> <label for="pin">PIN:</label>
                    <input type="password" id="pin" name="pin" maxlength="6">
                </div>
                @error('pin')
                <div class="error">
                    <small class="text-danger subtitle-sm mt-10">{{ $errors->first('pin') }}</small>
                </div>
                @enderror
            </div>
            <div class="mt-10  ">
                <button type="submit">Checkout</button>
            </div>
        </form>
    </div>
</div>
</div>

@stop