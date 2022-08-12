@extends('master.main')

@section('title', 'Help request: '.$helpRequest->decryptTitle())

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')

@section('content')

<div class="content-browsing container-sm m-auto">

    <div class="flex-column">
        <div class="content-sidebar">
            <div class="title text-primary mb-20">Help request: {{ $helpRequest->decryptTitle() }} ({{ $helpRequest->status() }})
            </div>
            @staff
            <form action="{{ route('post.staff.closehelprequest', ['helpRequest' => $helpRequest->id]) }}" method="post" class="mb-20">
                @csrf
                <button type="submit">close this help request</button>
            </form>
            @endstaff

        </div>
        <div class="content-profile">
            <div class="subtitle mb-10">Create new message</div>
            <form action="{{ route('post.helprequest', ['helpRequest' => $helpRequest->id]) }}" method="post">
                @csrf
                <div>
                    <div class="input-container ">
                        <label for="message">message</label>
                        <textarea id="message" name="message" rows="20" cols="50"></textarea>
                    </div>
                </div>
                <div class="mt-10">
                    <button type="submit">submit</button>
                </div>
            </form>
            <div>
                @foreach($messages as $message)
                <div class="container mt-10 subtitle-sm">
                    {{ $message->decryptMessage() }}
                    <div class="mt-20 description">
                        <small>{{ $message->user->username }} - {{ $message->creationDate() }}</small>
                    </div>
                </div>
                @endforeach
                <div>
                    {{ $messages->links('includes.components.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>

@stop