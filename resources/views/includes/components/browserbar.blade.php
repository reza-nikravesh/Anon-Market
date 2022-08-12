@if($section == 'edit')
<div class="mb-10">
    <form action="{{ route('post.deleteproduct', ['product' => $product->id]) }}" method="post">
        @csrf
        <button type="submit" class="text-danger">Delete this product</button>
    </form>
</div>
@endif
<div class="container mb-10">
    <a
        href="{{ $section == 'edit' ? route('images', ['section' => $section, 'product' => $product->id]) : route('images', ['section' => 'add']) }}">Images</a>
    <a
        href="{{ $section == 'edit' ? route('offers', ['section' => $section, 'product' => $product->id]) : route('offers', ['section' => 'add']) }}">Offers</a>
    <a
        href="{{ $section == 'edit' ? route('deliveries', ['section' => $section, 'product' => $product->id]) : route('deliveries', ['section' => 'add']) }}">Deliveries</a>
    <a
        href="{{ $section == 'edit' ? route('informations', ['section' => $section, 'product' => $product->id]) : route('informations', ['section' => 'add']) }}">Basic
        information</a>
</div>