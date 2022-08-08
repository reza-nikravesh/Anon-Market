@extends('product')

@section('product-form')

<div class="subtitle text-primary mb-10 mt-10">Product offers</div>
<div class="flex-row overflow-x-scroll">
    <table class="zebra table-space">
        <thead class="subtitle-sm text-secondary">
            <tr>
                <th>quantity</th>
                <th>price(in USD)</th>
                <th>mesure</th>
                <th>preview</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody class="description">
            @if($section == 'edit')
            @forelse($product->offers as $offer)
            <tr>
                <td>{{ $offer->quantity }}</td>
                <td>{{ $offer->price }}</td>
                <td>{{ $offer->mesure }}</td>
                <td>{{ $offer->quantity }} {{ $offer->mesure }} per {{ $offer->price }}</td>
                <td>
                    <form
                        action="{{ route('post.deleteoffer', ['section' => $section, 'offer' => $offer->id, 'product' => $product->id]) }}"
                        method="post">
                        @csrf
                        <button type="submit" class="text-danger">delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">The product has no offer!</td>
            </tr>
            @endforelse
            @else
            @forelse($offers as $offer)
            <tr>
                <td>{{ $offer['quantity'] }}</td>
                <td>{{ $offer['price'] }}</td>
                <td>{{ $offer['mesure'] }}</td>
                <td>{{ $offer['quantity'] }} {{ $offer['mesure'] }} per {{ $offer['price'] }}</td>
                <td>
                    <form action="{{ route('post.deleteoffer', ['section' => 'add', 'offer' => $offer['uuid']]) }}"
                        method="POST">
                        @csrf
                        <button type="submit" class="text-danger">delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">The product has no offer!</td>
            </tr>
            @endforelse
            @endif
        </tbody>
    </table>
</div>

<div class="container mt-20">
    <form
        action="{{ $section == 'edit' ? route('post.offer', ['section' => $section, 'product' => $product->id]) : route('post.offer', ['section' => 'add']) }}"
        method="POST">
        @csrf
        <div class="form-group">
            <div class="input-container w-50 mb-10">
                <label for="quantity">quantity</label>
                <input type="text" id="quantity" name="quantity" placeholder="max 999.999" maxlength="6">

            </div> @error('quantity')
            <div class="error">
                <span class="text-danger description mt-10">{{ $errors->first('quantity') }}</span>
            </div>
            @enderror
        </div>
        <div class="form-group">
            <div class="input-container w-50">
                <label for="price">price</label>
                <input type="text" id="price" name="price" placeholder="max $999.999" maxlength="6">
            </div> @error('price')
            <div class="error">
                <span class="text-danger description mt-10">{{ $errors->first('price') }}</span>
            </div>
            @enderror
        </div>
        <div class="form-group">
          <div class="input-container w-50">
		  <label for="mesure">mesure</label>
            <input type="text" id="mesure" name="mesure" placeholder="ex. grams" maxlength="10">
         
		  </div>   @error('mesure')
            <div class="error">
                <small class="text-danger description mt-10">{{ $errors->first('mesure') }}</small>
            </div>
            @enderror
        </div>
        <button class="mt-10"  type="submit">add offer</button>
    </form>
</div>
<div class="flex-row mt-10">
<a href="{{ $section == 'edit' ? route('images', ['section' => $section, 'product' => $product->id]) : route('images', ['section' => 'add']) }}"
    class="h3">back</a>
<a href="{{ $section == 'edit' ? route('deliveries', ['section' => $section, 'product' => $product->id]) : route('deliveries', ['section' => 'add']) }}"
    class="h3 float-right">next step</a>

</div>
@stop