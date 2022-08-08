@extends('master.main')

@section('title', 'Report product')

@section('no-content')

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<div class="w-full m-auto flex-column items-center mt-40">
<div class="flashdata description mt-20 text-center">Thank you for submitting a report!<br>You may add additional details below or simply close this tab.</div>
<div class="master" >
	<div class="title text-primary mb-20">Report product</div>
	<form action="{{ route('post.report', ['product' => $product->id]) }}" method="post">
		@csrf
		@foreach(config('general.reporting_causes') as $index => $cause)
			<div class="option flex-row items-center mt-10">
				<input type="radio" id="cause" name="cause" value="{{ $index }}"><label>{{ $cause }}</label>
				@if($index == 'other')
					<div class="input-container">
					<input type="text" id="other_cause" name="other_cause" placeholder="optional">
					</div>
				@endif
			</div>
		@endforeach
		<div class="input-container mb-10 mt-20">
			<label for="message">optional message</label>
			<textarea id="message" name="message" rows="10" cols="34"></textarea>
		</div>
		@include('includes.forms.captcha')
	</form>
</div>
</div>

@stop