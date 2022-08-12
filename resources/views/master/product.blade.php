@extends('master.main')

@section('title', $product->name)
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

<div class="content-master m-auto flex-row w-full">

    <div class="flex-colimn carrousel-container overflow-x-scroll">
        <div class="carrousel  ">
            @foreach($product->images as $index => $image)
            <div id="image{{ $index }}" class="slide">
                <img src="{{ $image->image }}" width="400px" height="300px">
            </div>
            @endforeach
        </div>
        <div class="mt-10 flex-row ">
            @foreach($product->images as $index => $image)
            <div class=" ">
                <a href="#image{{ $index }}"><img src="{{ $image->image }}" alt="{{ $product->name }}" width="72px" height="72px"></a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="product-alldetails  ">
        <div class="title text-primary">{{ $product->name }}</div>
        <div class="mt-20 description flex-row">
            <span class="price-big"><small>From</small> @include('includes.components.displayprice', ['price' =>
                $product->from()])</span>&ensp;&ensp;<a href="{{ route('report', ['product' => $product->id]) }}" target="_blank">Report this product</a>
        </div>
        <div class="container description mt-20">
            <span class="subtitle-sm text-primary">Seller:</span> <a href="{{ route('seller', ['seller' => $product->seller->username]) }}">{{ $product->seller->username }}({{ $product->seller->totalFeedbacks() }})</a>
            <p>Ships from: {{ $product->shipsFrom() }}</p>
            <p>Ships to: {{ $product->shipsTo() }}</p>
            <p>
                Finalize early (present):
                <strong>{{ $product->seller->finalizeEarly() == true ? 'Yes' : 'No' }}</strong>
            </p>
            <p>
                category: @foreach($product->category->parents() as $pc) <a href="{{ route('category', ['slug' => $pc->slug]) }}">{{ $pc->name }}</a> ➜ @endforeach <a href="{{ route('category', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a>
            </p>
            <form action="{{ route('post.favorites', ['product' => $product->id]) }}" method="post" class="mt-10">
                @csrf
                <button type="submit">{{ auth()->user()->isFavorite($product) ? 'Remove' : 'Add' }} to
                    favorites</button>
            </form>
        </div>
        <div class="container mt-10">
            <form action="{{ route('post.addtocart', ['product' => $product->id]) }}" method="post">
                @csrf
                <div class=" mt-10">
                    <label for="offer">Offers:</label>
                    <select id="offer" name="offer" class="dropdown-wrapper">
                        @foreach($product->offers as $offer)
                        <option value="{{ $offer->id }}">{{ $offer->quantity }} {{ $offer->mesure }} per
                            @include('includes.components.displayprice', ['price' => $offer->price])</option>
                        @endforeach
                    </select>
                </div>
                <div class=" mt-10">
                    <label for="delivery">Delivery method:</label>
                    <select id="delivery_method" name="delivery_method" class="dropdown-wrapper">
                        @foreach($product->deliveries as $delivery)
                        <option value="{{ $delivery->id }}">{{ $delivery->name }} - {{ $delivery->days }} day(s) -
                            @include('includes.components.displayprice', ['price' => $delivery->price])</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-10  ">
                    <button type="submit">Add to cart</button>
                </div>
                @can('update-product', $product)
                <div class="mt-10 ">
                    <a href="{{ route('images', ['section' => 'edit', 'product' => $product->id]) }}">Edit this
                        product</a>
                </div>
                @endcan
            </form>
        </div>
    </div>
    <div>
        <div class="container mt-40">
            <div class="subtitle text-primary">Description</div>
            <div class="description">{!! Illuminate\Support\Str::markdown(strip_tags($product->description)) !!}</div>
        </div>
        <div class="container mt-40">
            <div class="subtitle text-primary">Refund policy</div>
            <div class="description">{!! Illuminate\Support\Str::markdown(strip_tags($product->refund_policy)) !!}</div>
        </div>
    </div>
    <div class="w-full">
        <div class="subtitle text-primary mt-40">Customer reviews</div>
        <div class="flex-row overflow-x-scroll">
            <table class="zebra table-space mt-10">
                <thead class="subtitle-sm text-secondary">
                    <th>
                        <div class="flex-row items-center">
                            <span>
                                Rating
                            </span>
                            <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z" />
                            </svg>
                        </div>
                    </th>
                    <th>
                        <div class="flex-row items-center">
                            <span>
                                Type
                            </span>
                            <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M448 48V384c-63.09 22.54-82.34 32-119.5 32c-62.82 0-86.6-32-149.3-32C158.6 384 142.6 387.6 128 392.2v-64C142.6 323.6 158.6 320 179.2 320c62.73 0 86.51 32 149.3 32C348.9 352 364.1 349 384 342.7v-208C364.1 141 348.9 144 328.5 144c-62.82 0-86.6-32-149.3-32C128.4 112 104.3 132.6 64 140.7v307.3C64 465.7 49.67 480 32 480S0 465.7 0 448V63.1C0 46.33 14.33 32 31.1 32S64 46.33 64 63.1V76.66C104.3 68.63 128.4 48 179.2 48c62.73 0 86.51 32 149.3 32C365.7 80 384.9 70.54 448 48z" />
                            </svg>
                        </div>
                    </th>
                    <th>
                        <div class="flex-row items-center">
                            <span>
                                User
                            </span>
                            <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
                            </svg>
                        </div>
                    </th>
                    <th>
                        <div class="flex-row items-center">
                            <span>
                                Review
                            </span>
                            <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z" />
                            </svg>
                        </div>
                    </th>
                    <th>Freshness</th>
                </thead>
                <tbody class="description">
                    @forelse($feedbacks as $feedback)
                    <tr>
                        <td>{{ number_format($feedback->rating, 2) }} of 5</td>
                        <td>{{ $feedback->type }}</td>
                        <td>{{ $feedback->hiddenUser() }}</td>
                        <td style="text-align: left">{{ $feedback->message }}</td>
                        <td>{{ $feedback->freshness() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Humm... Looks like this product doesn't have any reviews yet.</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="5">{{ $feedbacks->links('includes.components.pagination') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop