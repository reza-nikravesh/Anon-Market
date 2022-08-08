<ul>
@foreach($subcategories as $subcategory)
	<li><a href="{{ route('admin.category', ['category' => $subcategory->id]) }}">{{ $subcategory->name }}</a><span class="description"> {{ $subcategory->totalProducts() }}</span>&nbsp;&nbsp;&nbsp;<a href="{{ route('delete.admin.category', ['category' => $subcategory->id]) }}" class="link-danger">delete</a></li>
	@if($subcategory->isParent())
		@include('includes.components.subcategorieslist', ['subcategories' => $subcategory->subcategories])
	@endif
@endforeach
</ul>