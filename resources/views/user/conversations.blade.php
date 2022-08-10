@extends('master.main')

@section('title', 'Conversations')
@include('includes.flash.error')
@section('content')
<div class="flex-column w-full container-sm   m-auto">
    <div>
        <div class="title text-primary mb-15">Create a new conversation</div>
        <form action="{{ route('post.conversations') }}" method="post">
            @csrf
            <div class="mb-10">
                <div class="input-container ">
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
                        <th>
                            <div class="inline-flex-row items-center">
                                <span>user</span>
                                <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z" />
                                </svg>
                            </div>
                        </th>
                        <th>
                            <div class="inline-flex-row items-center">
                                <span>unread</span>
                                <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path d="M150.7 92.77C195 58.27 251.8 32 320 32C400.8 32 465.5 68.84 512.6 112.6C559.4 156 590.7 207.1 605.5 243.7C608.8 251.6 608.8 260.4 605.5 268.3C592.1 300.6 565.2 346.1 525.6 386.7L630.8 469.1C641.2 477.3 643.1 492.4 634.9 502.8C626.7 513.2 611.6 515.1 601.2 506.9L9.196 42.89C-1.236 34.71-3.065 19.63 5.112 9.196C13.29-1.236 28.37-3.065 38.81 5.112L150.7 92.77zM223.1 149.5L313.4 220.3C317.6 211.8 320 202.2 320 191.1C320 180.5 316.1 169.7 311.6 160.4C314.4 160.1 317.2 159.1 320 159.1C373 159.1 416 202.1 416 255.1C416 269.7 413.1 282.7 407.1 294.5L446.6 324.7C457.7 304.3 464 280.9 464 255.1C464 176.5 399.5 111.1 320 111.1C282.7 111.1 248.6 126.2 223.1 149.5zM320 480C239.2 480 174.5 443.2 127.4 399.4C80.62 355.1 49.34 304 34.46 268.3C31.18 260.4 31.18 251.6 34.46 243.7C44 220.8 60.29 191.2 83.09 161.5L177.4 235.8C176.5 242.4 176 249.1 176 255.1C176 335.5 240.5 400 320 400C338.7 400 356.6 396.4 373 389.9L446.2 447.5C409.9 467.1 367.8 480 320 480H320z" />
                                </svg>

                            </div>
                        </th>
                        <th>
                            <div class="inline-flex-row items-center">
                                <span>total messages</span>
                                <svg class="ic-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z" />
                                </svg>
                            </div>

                        </th>
                        <th>
                            <div class="inline-flex-row items-center"><span>#</span></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conversations as $conversation)
                    <tr class="description">
                        <td>{{ $conversation->otherUser() }}</td>
                        <td>{{ $conversation->unreadMessages() }}</td>
                        <td>{{ $conversation->totalMessages() }}</td>
                        <td><a href="{{ route('conversationmessages', ['conversation' => $conversation->id]) }}">view</a>
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