@extends('master.main')

@section('title', 'Support')

@include('includes.flash.validation')
@include('includes.flash.error')

@section('content')

<div class=" m-auto container-sm  ">
    <div class="flex-column">
        <div class="title text-primary mb-10">Support</div>
        <div class="subtitle text-primary mb-10">Create help request</div>
        <form action="{{ route('post.createhelprequest') }}" method="post">
            @csrf
            <div class="input-container mb-10">
                <label for="title">Title</label>
                <input type="text" id="title" name="title">
            </div>
            <div class="info-wrapper ">
                <div class="info-folder">
                    <div class="info-icon">?</div>
                    <div class="info-message">If you have any questions, please contact the team! You can only have one
                        help request open at a time.</div>
                </div>
            </div>
            <div class="input-container">
                <label for="message">Message</label>
                <textarea id="message" name="message"></textarea>

            </div>
            <div class="  mt-10">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div class="flex-column mt-10">
        <div class="description">Help requests marked as closed are automatically deleted in 30 days!</div>
        <div class="flex-row overflow-x-scroll">
		  <table class="zebra table-space mt-10">
            <thead>
                <tr class="subtitle-sm text-secondary">
                    <th>title</th>
                    <th>status</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody class="description">
                @forelse($helpRequests as $helpRequest)
                <tr class="description">
                    <td>{{ $helpRequest->decryptTitle() }}</td>
                    <td><strong>{{ $helpRequest->status() }}</strong></td>
                    <td><a href="{{ route('helprequest', ['helpRequest' => $helpRequest->id]) }}">view</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">You haven't asked for any help yet!</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="3">{{ $helpRequests->links('includes.components.pagination') }}</td>
                </tr>
            </tbody>
        </table>
	</div>
      

    </div>
</div>

@stop