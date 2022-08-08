@extends('master.main')

@section('title', $category->name.' category')

@section('content')

<div class="flex-column m-auto">
    @include('includes.components.filters')
    <div class="title text-primary">Browsing {{ $category->name }}</div>
    <div class="filter-result flex-row justify-center">
        @forelse($products as $product)
        @include('includes.components.product.row', ['product' => $product])
        @empty
        <div class="subtitle-sm">This category has no products!</div>
        @endforelse
    </div>

    {{ $products->links('includes.components.pagination') }}
</div>

@stop