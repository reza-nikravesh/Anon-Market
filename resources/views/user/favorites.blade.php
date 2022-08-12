@extends('master.main')

@section('title', 'Favorites')

@section('content')

<div class="content-browsing">
	<div class="subtitle mb-10">Favorite listings . </div>
    <div class="flex-row ">
    @forelse($favorites as $favorite)
    	@include('includes.components.product.row', ['product' => $favorite->product])
    @empty
    </div>
    <br>
    	<div class="subtitle mt-20" >Looks like you don't have any products in your favorites yet!</div>
    @endforelse
    {{ $favorites->links('includes.components.pagination') }}
</div>

@stop