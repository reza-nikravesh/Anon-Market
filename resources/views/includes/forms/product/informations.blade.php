@extends('product')

@section('product-form')

<div class="mt-10 description text-primary flashdata flashdata-error mt-15 mb-15">The product description and refund policy must
    be a maximum of 5000 characters. Markdown is supported!</div>
<div class="subtitle text-primary mt-10">Basic product information</div>
<div class="container">
    <form
        action="{{ $section == 'edit' ? route('post.informations', ['section' => $section, 'product' => $product->id]) : route('post.informations', ['section' => 'add']) }}"
        method="post">
        @csrf
        <div class="form-group  mt-10">
            <div class="input-container w-50">
                <label for="name">product name</label>
                <input type="text" id="name" name="name" maxlength="50" @if($section=='edit' )
                    value="{{ $product->name }}" @endif>

            </div> @error('name')
            <div class="description mt-10  ">
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            @enderror
        </div>
        <div class="form-grou mt-10 ">
            <div class="input-container">
                <label for="category">category</label>
                <select id="category" name="category" class="dropdown-wrapper">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($section=='edit' and $product->category_id == $category->id)
                        selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>

            </div> @error('category')
            <div class="description mt-10 ">
                <small class="text-danger">{{ $errors->first('category') }}</small>
            </div>
            @enderror
        </div>
        <div class="form-group mt-10 ">
            <div class="input-container">
                <label for="ships_from">Ships from</label>
                <select id="ships_from" name="ships_from" class="dropdown-wrapper">
                    @foreach(config('countries') as $key => $shipsFrom)
                    <option value="{{ $key }}" @if($section=='edit' and $product->ships_from == $key) selected
                        @endif>{{ $shipsFrom }}</option>
                    @endforeach
                </select>

            </div> @error('ships_from')
            <div class=" description mt-10  ">
                <small class="text-danger">{{ $errors->first('ships_from') }}</small>
            </div>
            @enderror
        </div>
        <div class="form-group  mt-10">
            <div class="input-container">
                <label for="ships_to">Ships to</label>
                <select id="ships_to" name="ships_to" class="dropdown-wrapper">
                    @foreach(config('countries') as $key => $shipsTo)
                    <option value="{{ $key }}" @if($section=='edit' and $product->ships_to == $key) selected
                        @endif>{{ $shipsTo }}</option>
                    @endforeach
                </select>

            </div> @error('ships_to')
            <div class=" description mt-10  ">
                <span class="text-danger">{{ $errors->first('ships_to') }}</span>
            </div>
            @enderror
        </div>
        <div class="form-group mt-10">
            <div class="input-container">
			<label for="description">Description</label>
            <textarea id="description" name="description" cols="60"
                rows="15">@if($section == 'edit') {{ $product->description }} @endif</textarea>
         
			</div>   @error('description')
            <div class="description mt-10">
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
            @enderror
        </div>
        <div class="form-group mt-10">
          <div class="input-container">
		  <label for="refund_policy">Refund policy</label>
            <textarea id="refund_policy" name="refund_policy" cols="60"
                rows="15">@if($section == 'edit') {{ $product->refund_policy }} @endif</textarea>
    
		  </div>        @error('refund_policy')
            <div class="description mt-10">
                <span class="text-danger">{{ $errors->first('refund_policy') }}</span>
            </div>
            @enderror
        </div>
        <button class="mt-10" type="submit">Save product</button>
    </form>
</div>
<a href="{{ $section == 'edit' ? route('deliveries', ['section' => $section, 'product' => $product->id]) : route('deliveries', ['section' => 'add']) }}"
    class="h3">back</a>

@stop