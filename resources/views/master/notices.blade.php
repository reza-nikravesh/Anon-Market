@extends('master.main')

@section('title', 'Notice diary')

@section('content')

<div class="flex-column m-auto w-full">
    <div class=" subtitle text-primary">Notice diary ({{ $notices->count() }})</div>
    <div class="flex-row overflow-x-scroll ">
        <table class="zebra table-space ">
            <thead>
                <tr class="subtitle-sm text-secondary">
                    <th>title</th>
                    <th>author</th>
                    <th>created at</th>
                    <th>updated at</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notices as $notice)
                <tr class="description">
                    <td><a href="{{ route('notice', ['notice' => $notice->id]) }}">{{ $notice->title }}</td>
                    <td>{{ $notice->user->username }}</td>
                    <td>{{ $notice->createdAt() }}</td>
                    <td>{{ $notice->updatedAt() }}</td>
                </tr>
                @empty
                <tr>
                    <td class="description description" colspan="4">There are still no notices around here!</td>
                </tr>
                @endforelse
                <tr>
                    <td class="subtitle-sm" colspan="4">{{ $notices->links('includes.components.pagination') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop