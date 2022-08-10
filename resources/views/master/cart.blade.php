@extends('master.main')

@section('title', "Shopping cart ($totalProducts)")
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

<div class="flex-column m-auto w-full container-md">

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
                    <th>
                        <div class="inline-flex-row items-center">
                            <span>Product</span>
                            <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M50.73 58.53C58.86 42.27 75.48 32 93.67 32H208V160H0L50.73 58.53zM240 160V32H354.3C372.5 32 389.1 42.27 397.3 58.53L448 160H240zM448 416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V192H448V416z" />
                            </svg>
                        </div>
                    </th>
                    <th>
                        <div class="inline-flex-row items-center">
                            <span>Seller</span>
                            <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
                            </svg>
                        </div>
                    </th>
                    <th>
                        <div class="inline-flex-row items-center">
                            <span>Quantity</span>
                           
                        </div>
                    </th>
                    <th>
                        <div class="inline-flex-row items-center">
                            <span>Price</span>
                            <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M160 0C177.7 0 192 14.33 192 32V67.68C193.6 67.89 195.1 68.12 196.7 68.35C207.3 69.93 238.9 75.02 251.9 78.31C268.1 82.65 279.4 100.1 275 117.2C270.7 134.3 253.3 144.7 236.1 140.4C226.8 137.1 198.5 133.3 187.3 131.7C155.2 126.9 127.7 129.3 108.8 136.5C90.52 143.5 82.93 153.4 80.92 164.5C78.98 175.2 80.45 181.3 82.21 185.1C84.1 189.1 87.79 193.6 95.14 198.5C111.4 209.2 136.2 216.4 168.4 225.1L171.2 225.9C199.6 233.6 234.4 243.1 260.2 260.2C274.3 269.6 287.6 282.3 295.8 299.9C304.1 317.7 305.9 337.7 302.1 358.1C295.1 397 268.1 422.4 236.4 435.6C222.8 441.2 207.8 444.8 192 446.6V480C192 497.7 177.7 512 160 512C142.3 512 128 497.7 128 480V445.1C127.6 445.1 127.1 444.1 126.7 444.9L126.5 444.9C102.2 441.1 62.07 430.6 35 418.6C18.85 411.4 11.58 392.5 18.76 376.3C25.94 360.2 44.85 352.9 60.1 360.1C81.9 369.4 116.3 378.5 136.2 381.6C168.2 386.4 194.5 383.6 212.3 376.4C229.2 369.5 236.9 359.5 239.1 347.5C241 336.8 239.6 330.7 237.8 326.9C235.9 322.9 232.2 318.4 224.9 313.5C208.6 302.8 183.8 295.6 151.6 286.9L148.8 286.1C120.4 278.4 85.58 268.9 59.76 251.8C45.65 242.4 32.43 229.7 24.22 212.1C15.89 194.3 14.08 174.3 17.95 153C25.03 114.1 53.05 89.29 85.96 76.73C98.98 71.76 113.1 68.49 128 66.73V32C128 14.33 142.3 0 160 0V0z" />
                            </svg>
                        </div>
                    </th>
                    <th>
                        <div class="inline-flex-row items-center">
                            <span>Delivery</span>
                            <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path d="M368 0C394.5 0 416 21.49 416 48V96H466.7C483.7 96 499.1 102.7 512 114.7L589.3 192C601.3 204 608 220.3 608 237.3V352C625.7 352 640 366.3 640 384C640 401.7 625.7 416 608 416H576C576 469 533 512 480 512C426.1 512 384 469 384 416H256C256 469 213 512 160 512C106.1 512 64 469 64 416H48C21.49 416 0 394.5 0 368V48C0 21.49 21.49 0 48 0H368zM416 160V256H544V237.3L466.7 160H416zM160 368C133.5 368 112 389.5 112 416C112 442.5 133.5 464 160 464C186.5 464 208 442.5 208 416C208 389.5 186.5 368 160 368zM480 464C506.5 464 528 442.5 528 416C528 389.5 506.5 368 480 368C453.5 368 432 389.5 432 416C432 442.5 453.5 464 480 464z" />
                            </svg>
                        </div>
                    </th>
                    <th>
                        <div class="inline-flex-row items-center">
                            Sub-total
                        </div>
                    </th>
                    <th>
                        <div class="inline-flex-row items-center">
                            #
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="description">
                    <td><a href="{{ route('product', ['product' => $product['product_id'] ]) }}">{{ $product['product_name'] }}</a>
                    </td>
                    <td><a href="{{ route('seller', ['seller' => $product['seller'] ]) }}">{{ $product['seller'] }}</a></td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>@include('includes.components.displayprice', ['price' => $product['price']])</td>
                    <td>{{ $product['delivery_method'] }} - @include('includes.components.displayprice', ['price' =>
                        $product['delivery_price']])</td>
                    <td>@include('includes.components.displayprice', ['price' => $product['total']])</td>
                    <td>
                        <form action="{{ route('post.removetocart', ['product' => $product['product_id'] ]) }}" method="post">
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
            {{ \App\Tools\Converter::moneroConverter($totalPrice) }} XMR
        </div>
        <div class="info-wrapper">
            <div class="info-folder">
                <div class="info-icon">?</div>
                <div class="info-message">Your address will be encrypted with the sellers' PGP key, ensuring that only
                    they will have access to your information! See how we protect your identity in the <a href="{{ config('general.wiki_link') }}" target="_blank"><strong>buyer's guide</strong></a>.
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