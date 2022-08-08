@extends('master.main')

@section('title', 'Conversations')
@include('includes.flash.error')
@section('content')
<div class="flex-column w-full m-auto">
    <div>
        <div class="title text-primary mb-15">Create a new conversation</div>
        <form action="{{ route('post.conversations') }}" method="post">
            @csrf
            <div class="mb-10">
                <div class="input-container w-50">
                    <label for="username">Receivers username</label>
                    <input type="text" id="username" name="username" value="{{ $user }}">
                </div>
                @error('username')
                <div class="error ">
                    <small class="text-danger description">{{ $errors->first('username') }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-10">
                <div class="input-container">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" cols="40" rows="15"></textarea>
                </div>
                @error('message')
                <div class="error ">
                    <small class="text-danger description">{{ $errors->first('message') }}</small>
                </div>
                @enderror
            </div>
            <div class="mb-10">
                <label for="encrypted">Auto encrypt</label>
                <input type="checkbox" id="encrypted" name="encrypted" value="1">
                <div class="info-wrapper">
                    <div class="info-folder">
                        <div class="info-icon">?</div>
                        <div class="info-message">The message will automatically be encrypted with the PGP key of the
                            receiving user.</div>
                    </div>
                </div>
            </div>
            @include('includes.forms.captcha')
        </form>
    </div>

    <div>
        <div class="  subtitle text-primary mb-10">All conversations (active or not) older than 30 days will be deleted!
        </div>
        <div class="flex-row overflow-x-scroll">
            <table class="zebra table-space">
                <thead>
                    <tr class="subtitle-sm text-secondary">
                        <th>user</th>
                        <th>unread</th>
                        <th>total messages</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conversations as $conversation)
                    <tr class="description">
                        <td>{{ $conversation->otherUser() }}</td>
                        <td>{{ $conversation->unreadMessages() }}</td>
                        <td>{{ $conversation->totalMessages() }}</td>
                        <td><a
                                href="{{ route('conversationmessages', ['conversation' => $conversation->id]) }}">view</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $conversations->links('includes.components.pagination') }}
    </div>
</div>
@stop