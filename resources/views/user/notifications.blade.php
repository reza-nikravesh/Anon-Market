@extends('master.main')

@section('title', 'Notifications')

@section('content')

<div class="content-browsing   w-full m-auto" >
	<div class=" mb-15 title text-primary ">Notifications ({{ auth()->user()->totalUnreadNotifications() }})</div>
	
	<div class="flex-column">
	<div class="flex-row overflow-x-scroll">
        
		<table class="zebra table-space">
			<thead >
				<tr class="subtitle-sm text-secondary">
					<th   >Notification</th>
				</tr>
			</thead>
			<tbody>
				@forelse($notifications as $notification)
				<tr class="description">
					<td  >{!! $notification->label !!}</td>
				</tr>
				@empty
				<tr class="description">
					<td colspan="2">Hmm... Looks like you don't have any notifications!</td>
				</tr>
				@endforelse
				<tr class="description">
					<td colspan="2">{{ $notifications->links('includes.components.pagination') }}</td>
				</tr>
			</tbody>
		</table>
    </div>
	<form action="{{ route('delete.notifications') }}" method="post" class="mb-10">
		@csrf
		@method('delete')
		<button type="submit">Clear</button>
	</form>
	</div>
</div>

@stop