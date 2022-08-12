@extends('master.main')

@section('title', 'Admin users')

@section('content')

@include('includes.components.menustaff')

<div class="content-profile container-md">
	<div class="title text-primary">All users ({{ $totalUsers }})</div>
	<form   action="{{ route('admin.users', ['username' => $username, 'role' => $role]) }}" method="GET" class="mt-10">
		<div class="input-container w-50">
			<label for="username">username:</label>
			<input type="text" id="username" name="username" value="{{ $username }}">
		</div>
		<div >
			<div class="input-container mt-10">
			<label for="role">role</label>
			<select id="role" name="role" class="dropdown-wrapper">
				<option value="all" @if($role == 'all') selected @endif>all</option>
				<option value="seller" @if($role == 'seller') selected @endif>seller</option>
				<option value="moderator" @if($role == 'moderator') selected @endif>moderator</option>
				<option value="admin" @if($role == 'admin') selected @endif>admin</option>
			</select>
			</div>
		</div>
			<button class="mt-10" type="submit">filter</button>
	</form>
	<div class="flex-row overflow-x-scroll">
		<table class="zebra mt-10 text-center" >
		<thead class="subtitle-sm text-secondary">
			<tr >
				<th>username</th>
				<th>seller</th>
				<th>moderator</th>
				<th>admin</th>
				<th>last login</th>
				<th>completed orders</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody class="description">
			@forelse($users as $user)
			<tr>
				<td>{{ $user->username }}</td>
				<td><strong>{{ $user->isSeller() ? 'Yes' : 'No' }}</strong></td>
				<td><strong>{{ $user->isModerator() ? 'Yes' : 'No' }}</strong></td>
				<td><strong>{{ $user->isAdmin() ? 'Yes' : 'No' }}</strong></td>
				<td>{{ $user->lastLogin() }}</td>
				<td>{{ $user->totalOrdersCompleted() }}</td>
				<td><a href="{{ route('admin.user', ['user' => $user->id]) }}">edit user</a></td>
			</tr>
			@empty
			<tr>
				<td colspan="7">Looks like there aren't any users around here!</td>
			</tr>
			@endforelse
			<tr>
				<td colspan="7">{{ $users->appends($filters)->links('includes.components.pagination') }}</td>
			</tr>
		</tbody>
	</table>
	</div>
	
</div>

@stop