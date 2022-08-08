@extends('master.main')

@section('title', $product->name)
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

<div class="content-master m-auto flex-row w-full">

    <div class="flex-colimn overflow-x-scroll">
        <div class="carrousel  ">
            @foreach($product->images as $index => $image)
            <div id="image{{ $index }}" class="slide">
                <img src="{{ $image->image }}" width="400px" height="300px">
            </div>
            @endforeach
        </div>
        <div class="mt-10 flex-row border">
            @foreach($product->images as $index => $image)
            <div class=" ">
                <a href="#image{{ $index }}"><img src="{{ $image->image }}" alt="{{ $product->name }}" width="72px"
                        height="72px"></a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="product-alldetails  ">
        <div class="title text-primary">{{ $product->name }}</div>
        <div class="mt-20 description flex-row">
            <span class="price-big"><small>From</small> @include('includes.components.displayprice', ['price' =>
                $product->from()])</span>&ensp;&ensp;<a href="{{ route('report', ['product' => $product->id]) }}"
                target="_blank">Report this product</a>
        </div>
        <div class="container description mt-20">
            <span class="subtitle-sm text-primary">Seller:</span> <a
                href="{{ route('seller', ['seller' => $product->seller->username]) }}">{{ $product->seller->username }}({{ $product->seller->totalFeedbacks() }})</a>
            <p>Ships from: {{ $product->shipsFrom() }}</p>
            <p>Ships to: {{ $product->shipsTo() }}</p>
            <p>
                Finalize early (present):
                <strong>{{ $product->seller->finalizeEarly() == true ? 'Yes' : 'No' }}</strong>
            </p>
            category: @foreach($product->category->parents() as $pc) <a
                href="{{ route('category', ['slug' => $pc->slug]) }}">{{ $pc->name }}</a> ➜ @endforeach <a
                href="{{ route('category', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a>
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
    <div class="container mt-40">
        <div class="subtitle text-primary">Description</div>
        <div class="description">{!! Illuminate\Support\Str::markdown(strip_tags($product->description)) !!}</div>
    </div>
    <div class="container mt-40">
        <div class="subtitle text-primary">Refund policy</div>
        <div class="description">{!! Illuminate\Support\Str::markdown(strip_tags($product->refund_policy)) !!}</div>
    </div>
    <div class="w-full">
        <div class="subtitle text-primary mt-40">Customer reviews</div>
        <div class="flex-row overflow-x-scroll">
            <table class="zebra table-space mt-10">
                <thead class="subtitle-sm text-secondary">
                    <th>Rating</th>
                    <th>Type</th>
                    <th>User</th>
                    <th>Review</th>
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