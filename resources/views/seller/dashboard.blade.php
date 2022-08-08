@extends('master.main')

@section('title', 'Seller dashboard')

@include('includes.flash.success')
@section('content')

@include('includes.components.menuaccount')
<div class="content-profile">
    <div class="title text-primary mb-15">Seller dashboard</div>
    <div class="flashdata flashdata-error mb-10 description">Your description and rules must have a maximum of 10000
        characters. Markdown is supported!</div>
    <form action="{{ route('put.seller.dashboard') }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="input-container">
                <label for="description">my description</label>
                <textarea id="description" name="description" rows="18">{{ $seller->seller_description }}</textarea>

            </div> @error('description')
            <div class="error">
                <small class="text-danger">{{ $errors->first('description') }}</small>
            </div>
            @enderror
        </div>
        <div class="form-group mt-10">
            <div class="input-container">
                <label for="rules">my rules</label>
                <textarea id="rules" name="rules" rows="18">{{ $seller->seller_rules }}</textarea>

            </div> @error('rules')
            <div class="error">
                <small class="text-danger">{{ $errors->first('rules') }}</small>
            </div>
            @enderror
        </div>
        <button class="mt-10" type="submit">save profile</button>
    </form>
    <div class="  mt-20">
        <a href="{{ route('images', ['section' => 'add']) }}">
            <div class="h3">add product</div>
        </a>
    </div>
    <div class="flex-row overflow-x-scroll">
        <table class="zebra table-space mt-20">
            <thead class="subtitle-sm text-secondary">
                <tr>
                    <th>Featured image</th>
                    <th>Product name</th>
                    <th>From</th>
                    <th>Ships to</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody class="description">
                @forelse($products as $product)
                <tr>
                    <td><img src="{{ $product->featuredImage() }}" width="32px" height="32px"></td>
                    <td><a href="{{ route('product', ['product' => $product->id]) }}">{{ $product->name }}</a></td>
                    <td>@include('includes.components.displayprice', ['price' => $product->from()])</td>
                    <td>{{ $product->shipsTo() }}</td>
                    <td>
                        <div class="inblock">
                            <button><a href="{{ route('images', ['section' => 'edit', 'product' => $product->id]) }}"
                                    class="button">Edit</a></button>
                        </div>
                        <div class="inblock">
                            <form action="{{ route('post.deleteproduct', ['product' => $product->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="text-error">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">You don't have any products!</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="5">{{ $products->links('includes.components.pagination') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@stop