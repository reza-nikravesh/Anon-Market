@extends('master.main')

@section('title', 'Admin edit user')

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile">
	<div class="title text-primary">Edit user {{ $user->username }}</div>
	<div class="box mt-10">
		<div>
		<div class="subtitle text-primary mb-10">Basic information</div>
		<form action="{{ route('put.admin.edituser', ['user' => $user->id]) }}" method="post">
			@csrf
			@method('PUT')
			<div class="input-container w-50">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" value="{{ $user->username }}">
			</div>
			<div class="input-container w-50 mt-10">
				<label for="reference_code">Reference code</label>
				<input type="text" id="reference_code" name="reference_code" value="{{ $user->reference_code }}">
			</div>
			<div class="description mt-10 ">
				<label for="finalizearly">Finalize early</label>
				<input type="radio" id="finalizearly" name="finalizearly" value="1" @if($user->finalizeEarly()) checked @endif>yes
				<input type="radio" id="finalizearly" name="finalizearly" value="0" @if(!$user->finalizeEarly()) checked @endif>no
			</div>
			<br>
			<div class="description">
				<strong>last login: {{ $user->lastLogin() }}</strong>
			</div>
			<div class="subtitle text-primary mt-20">PGP key</div>
			<textarea  rows="15" cols="40" disabled>{{ $user->pgp_key }}</textarea>
			<div class="subtitle text-primary mt-20 mb-10">Role</div>
			<input type="checkbox" id="seller" name="role[]" value="seller" @if($user->isSeller()) checked @endif><label for="seller">Seller</label>
			<input type="checkbox" id="moderator" name="role[]" value="moderator" @if($user->isModerator()) checked @endif><label for="moderator">Moderator</label>
			<input type="checkbox" id="admin" name="role[]" value="admin" @if($user->isAdmin()) checked @endif><label for="admin">Admin</label>
			<div class="mt-10">
				<button type="submit">Edit {{ $user->username }}</button>
			</div>
		</form>
		</div>
	</div>
</div>

@stop