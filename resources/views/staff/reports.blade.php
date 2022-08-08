@extends('master.main')

@section('title', 'Staff reports')

@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile">
    <div class="title text-primary">All reports ({{ $reports->count() }})</div>
    <div class="flex-row overflow-x-scroll">
        <table class="zebra mt-10">
            <thead>
                <tr class="subtitle-sm text-secondary">
                    <th>Product</th>
                    <th>Author</th>
                    <th>Cause</th>
                    <th>Message</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody class="description">
                @forelse($reports as $report)
                <tr>
                    <td><a
                            href="{{ route('product', ['product' => $report->product->id]) }}">{{ $report->product->name }}</a>
                    </td>
                    <td>{{ $report->user->username }}</td>
                    <td>{{ $report->cause }}</td>
                    <td>
                        <textarea disabled >{{ $report->decryptMessage() }}</textarea>
                    </td>
                    <td>
                        <form action="{{ route('delete.staff.report', ['report' => $report->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger">delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">The market does not have any reports yet!</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="5">{{ $reports->links('includes.components.pagination') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@stop