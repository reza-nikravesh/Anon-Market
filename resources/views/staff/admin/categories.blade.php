@extends('master.main')

@section('title', 'Admin categories')

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')

<div class="content-profile">
    <div class="title text-primary">Add new category</div>
    <div class="box description mt-10">
        <div class="flex-column">
            <span class="subtitle text-primary">Comments</span>
            <ul class="list-indent list-style-disc">
                <li>The category name must be unique.</li>
                <li>You can only delete a category if it doesn't have any items.</li>
                <li>The slug is by default named after the category.</li>
            </ul>
        </div>
    </div>
    <form action="{{ route('post.admin.addcategories') }}" method="post" class="mt-10">
        @csrf
        <div class="input-container w-50">
            <div class="input-container">
                <label for="name">category name</label>
                <input type="text" id="name" name="name">
            </div>
            <select id="parent_category" name="parent_category" class="dropdown-wrapper">
                @foreach($allCategories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="mt-10 mb-10" type="submit">create category</button>
    </form>
    <ul>
        @forelse($rootsCategories as $category)
        <li><a href="{{ route('admin.category', ['category' => $category->id]) }}">{{ $category->name }}</a> <span
                class="description">{{ $category->totalProducts() }}</span>&nbsp;&nbsp;&nbsp;<a
                href="{{ route('delete.admin.category', ['category' => $category->id]) }}"
                class="link-danger">delete</a></li>
        @if(!empty($category->subcategories))
        @include('includes.components.subcategorieslist', ['subcategories' => $category->subcategories])
        @endif
        @empty
        <div class="h3">Hmm... It seems that the market still doesn't have any categories!</div>
        @endforelse
    </ul>
</div>

@stop