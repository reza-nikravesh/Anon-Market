@extends('master.main')

@section('title', 'Result')

@section('content')

<div class="flex-column m-auto">
    @include('includes.components.filters')
    <div class="title text-primary mb-10 mt-20">Search result</div>
    <div class="flex-row ">
        @forelse($products as $product)
        @include('includes.components.product.row', ['product' => $product])
        @empty
        <div class="subtitle text-primary mt-20 text-center">Hmm... We don't seem to find any results...
        </div>
        @endforelse
    </div>
    {{ $products->appends($filters)->links('includes.components.pagination') }}
</div>

@stop