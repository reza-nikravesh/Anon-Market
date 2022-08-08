@extends('master.main')

@section('title', 'Product')

@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

<div class="content-master w-full">
	<div class="title text-primary mb-15">{{ $section != 'add' ? 'Edit product' : 'Add new product' }}</div>
	@include('includes.components.browserbar')
	@yield('product-form')
</div>

@stop