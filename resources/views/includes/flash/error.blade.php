@if(session()->has('error'))
	<div class="alert">
		{{ session()->get('error') }}
	</div>
@endif