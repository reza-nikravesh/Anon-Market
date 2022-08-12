@extends('master.main')

@section('title', 'Home')

@section('content')

<div class="content-sidebar bottom-space" >
	@include('includes.components.notices')
	@include('includes.components.yoursellers')
</div>
<div class="content-homepage container-md ">
	@foreach($featuredProducts as $featuredProduct)
		@include('includes.components.product.featured', ['product' => $featuredProduct])
	@endforeach
	<div class="rodape"></div>
</div>

@stop