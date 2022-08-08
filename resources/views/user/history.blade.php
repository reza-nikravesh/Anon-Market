@extends('master.main')

@section('title', 'Account history')

@section('content')

@include('includes.components.menuaccount')
<div class="content-profile">
    <div class="title text-primary mb-15">Account history</div>
    <div class="description">
        All transfers involving your receiving address will be recorded here. You can delete them at any time!
    </div>
    <form action="{{ route('clear.history') }}" method="post" class=" mb-10 mt-10">
        @csrf
        @method('DELETE')
        <button type="submit">clear</button>
    </form>

    <div class="flex-row overflow-x-scroll">
        <table class="zebra table-space">
            <thead class="subtitle-sm text-secondary">
                <th>action</th>
                <th>amount</th>
                <th>balance</th>
                <th>date</th>
            </thead>
            <tbody>
                @forelse($transitions as $transition)
                <tr class="description">
                    <td>{{ $transition->action }}</td>
                    <td>{{ $transition->amount }}</td>
                    <td>{{ $transition->balance }}</td>
                    <td>{{ $transition->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td class="description" colspan="4">No transactions registered.</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="4">{{ $transitions->links('includes.components.pagination') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop