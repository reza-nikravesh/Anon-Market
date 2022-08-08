@extends('master.main')

@section('title', 'Define PGP key')

@section('no-content')

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
<div class=" box flex-column w-full m-auto mt-40 bg-paper">
    <div class="subtitle ">Set PGP key</div>
    <div class="description text-secondary">To use our services you need to set a pgp key.</div>
    @if(!session()->has('verification_name') and session()->get('verification_name') !== 'confirm_new_pgp_key')
    <form class="flex-column" action="{{ route('post.setpgpkey') }}" method="post">
        @csrf
        <div class="input-container text-secondary">
            <label for="pgp_key">PGP key</label>
            <textarea id="pgp_key" name="pgp_key"></textarea>
        </div>
        <div class='buttons justify-start'>
            <button class="bg-default text-primary" type="submit">Next step</button>
            <a href="{{ route('logout') }}"><button class="bg-default text-primary">Logout</button></a>
        </div>
    </form>
    @else
    <form action="{{ route('put.setpgpkey') }}" method="post">
        @csrf
        @method('PUT')
        <div class="input-container text-secondary">
            <label>Encrypted message</label>
            <textarea disabled>{{ session()->get('encrypted_message') }}</textarea>
        </div>
        <div class="description text-secondary mt-10">Decrypt the above message with the PGP key entered and copy and paste the
            verification
            code into the field below.</div>
        <div class="input-container w-50 text-secondary">
            <label for="verification_code">Verification code</label>
            <input type="text" id="verification_code" name="verification_code">

        </div>
        <div class="buttons justify-start mt-10">
            <a href="{{ route('cancelsetpgpkey') }}"><button class="bg-default text-primary" type="button">Cancel</button></a>
            <button class="bg-default text-primary" type="submit">Confirm</button>
        </div>
    </form>
    @endif
</div>

@stop