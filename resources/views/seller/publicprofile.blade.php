@extends('master.main')

@section('title', $seller->username.' Vendor')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

<div class="w-full m-auto flex-row">
    <div class="featured-listings-sidebar  ">
        <div class="subtitle text-primary mb-20">Random listings</div>
        <div class="featured-product-sidebar">
            @foreach($seller->randomListings() as $product)
            <div class="box justify-center border-light">
            <div class="  flex-column">
                <a href="{{ route('product', ['product' => $product->id]) }}">
                    <img src="{{ $product->featuredImage() }}" class="product-image" width="180px" height="135px">
                    <div class="featured-product-title">{{ $product->name }}</div>
                </a>
                <span class="price-small"><small>from</small> {{ $product->from() }}</span>
            </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="content-profile   flex-grow-1">

        <div class="title text-primary mb-10">{{ $seller->username }}</div>
        <div class="mb-10">
            <img src="{{ $seller->avatar }}" width="114px" height="114px">
        </div>
        <div class="  box description">
            <div>
                Positive feedbacks: <strong>{{ $seller->totalFeedbacks('positive') }}</strong><br>
                Neutral feedbacks: <strong>{{ $seller->totalFeedbacks('neutral') }}</strong><br>
                Negative feedbacks: <strong>{{ $seller->totalFeedbacks('negative') }}</strong><br>
                <div class="mt-20">
                    <strong>Fe enable(?): @if($seller->finalizeEarly()) &#10003; @else &#10005; @endif</strong>
                </div>
            </div>
        </div>
        <br>
        <a href="{{ route('conversations', ['user' => $seller->username]) }}">send a message</a>
        <div class="box description mt-40 mb-40">
            <div>
                Was last seen: <strong>{{ $seller->lastLogin() }}</strong><br>
                Sales with <strong>{{ $seller->ratePositiveFeedbacks() }}</strong> positive feedback from a total of
                <strong>{{ $seller->totalFeedbacks() }}</strong> feedbacks, won
                <strong>{{ $seller->wonDisputes() }}</strong>
                disputes out of a total of <strong>{{ $seller->totalDisputes() }}</strong> disputes<br>
                Has <strong>{{ $seller->totalFans() }}</strong> fans -
                <form action="{{ route('post.fan', ['seller' => $seller->username]) }}" method="post" class="inblock">
                    @csrf
                    <button
                        class="btn-link description">{{ !auth()->user()->isFan($seller) ? 'Become a fan!' : 'Stop being a fan' }}</button>
                </form>
            </div>
        </div>
        <div class="container mb-40">
            <div class="subtitle text-primary">Description</div>
            <div class="description">
                {!! Illuminate\Support\Str::markdown(strip_tags($seller->seller_description)) !!}
            </div>
        </div>
        <div class="container mb-40">
            <div class="subtitle text-primary">Rules</div>
            <div class="description">
                {!! Illuminate\Support\Str::markdown(strip_tags($seller->seller_rules)) !!}
            </div>
        </div>
        <div class="container mb-40">
            <div class="subtitle text-primary mb-10">PGP key</div>
            <pre class="description"></pre>
            <textarea disabled>
			{{ $seller->pgp_key }}
			</textarea>
        </div>
        <div class="subtitle text-primary mt-40">Products</div>
        <div class="flex-row overflow-x-scroll">
            <table class="zebra mt-10 text-center">
                <thead class="subtitle-sm text-secondary ">
                    <th>Featured image</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>From</th>
                    <th>Ships to</th>
                    <th>Ships from</th>
                </thead>
                <tbody class="description text-secondary ">
                    @forelse($products as $product)
                    <tr>
                        <td><img src="{{ $product->featuredImage() }}" height="32px" width="32px"></td>
                        <td><a
                                href="{{ route('category', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a>
                        </td>
                        <td><a href="{{ route('product', ['product' => $product->id]) }}">{{ $product->name }}</a></td>
                        <td>@include('includes.components.displayprice', ['price' => $product->from()])</td>
                        <td>{{ $product->shipsTo() }}</td>
                        <td>{{ $product->shipsFrom() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Humm... Looks like this vendor doesn't have any products.</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="6">{{ $products->links('includes.components.pagination') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="subtitle text-primary mt-40">Customers reviews</div>
        <div class="flex-row overflow-x-scroll">
            <table class="zebra mt-10">
                <thead class="subtitle-sm text-secondary ">
                    <th>Rating</th>
                    <th>Type</th>
                    <th>User</th>
                    <th>Review</th>
                    <th>Freshness</th>
                    <th>Product</th>
                </thead>
                <tbody class="description">
                    @forelse($feedbacks as $feedback)
                    <tr>
                        <td>{{ number_format($feedback->rating, 2) }} of 5</td>
                        <td>{{ $feedback->type }}</td>
                        <td>{{ $feedback->hiddenUser() }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->freshness() }}</td>
                        <td><a href="{{ route('product', ['product' => $feedback->product->id]) }}">view</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Humm... It looks like this Vendor has no reviews.</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="6">{{ $feedbacks->links('includes.components.pagination') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


</div>
@stop