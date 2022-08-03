@extends('master.main')

@section('title', 'Staff support')

@section('content')

@include('includes.components.menustaff')
<div class="content-profile">
	@include('includes.flash.success')
	@include('includes.flash.error')
	<div class="h3 mb-10">All help requests ({{ $totalHelpRequests }})</div>
	<form action="{{ route('staff.support', ['status' => $status]) }}" method="get">
		<label for="status">Status:</label>
		<select class="dropdown-wrapper" id="status" name="status">
			<option value="closed">Closed</option>
			<option value="open">Open</option>
		</select>
		<button type="submit">Filter</button>
	</form>
	<div class="footnote">Help requests marked as closed are automatically deleted in 30 days!</div>
	<table class="zebra mt-10" style="width: 100%; text-align: center">
		<thead>
			<tr>
				<th>User</th>
				<th>Title</th>
				<th>Status</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
			@forelse($helpRequests as $helpRequest)
			<tr>
				<td>{{ $helpRequest->user->username }}</td>
				<td><a href="{{ route('helprequest', ['helpRequest' => $helpRequest->id]) }}">{{ $helpRequest->decryptTitle() }}</a></td>
				<td><strong>{{ $helpRequest->status() }}</strong></td>
				<td>
					<form action="{{ route('delete.staff.helprequest', ['helpRequest' => $helpRequest->id]) }}" method="post" class="inblock">
						@csrf
						@method('DELETE')
						<button type="submit" class="text-danger">Delete</button>
					</form>
					<form action="{{ route('post.staff.closehelprequest', ['helpRequest' => $helpRequest->id]) }}" method="post" class="inblock">
						@csrf
						<button type="submit">Close help</button>
					</form>
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="4">No help requests were found!</td>
			</tr>
			@endforelse
			<tr>
				<td colspan="4">{{ $helpRequests->appends($filters)->links('includes.components.pagination') }}</td>
			</tr>
		</tbody>
	</table>
</div>

@stop