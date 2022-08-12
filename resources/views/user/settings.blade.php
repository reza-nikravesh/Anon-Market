@extends('master.main')

@section('title', 'Account settings')
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menuaccount')
<div class="content-profile container-md">

    <div class="title text-primary mb-15">Account Settings</div>

    <div class="container mb-20">
        <div class="info-wrapper ">
            <div class="info-folder">
                <div class="info-icon">?</div>
                <div class="info-message">Choose an image that is less than 30kb and is in png or jpg format.</div>
            </div>
        </div>
        <div class="subtitle text-primary mb-10">Change avatar</div>
        <form action="{{ route('put.changeavatar') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <img class="mb-10" src="{{ auth()->user()->avatar }}" width="96px" height="96px">
            <div class="form-group container">
                <div class="input-container">
                    <label class="w-full" for="avatar">avatar</label>
                    <input class="w-full" type="file" id="avatar" name="avatar">
                </div>
                <button class="mt-10" type="submit">change avatar</button>
            </div>
        </form>
    </div>
    <div class="container mb-20">
        <div class="info-wrapper float-right">
            <div class="info-folder">
                <div class="info-icon">?</div>
                <div class="info-message">To change your password, simply enter your current password in the
                    corresponding field and then enter a new password.</div>
            </div>
        </div>



        <div class="subtitle text-primary mt-10 mb-10">Change password</div>
        <form action="{{ route('put.changepassword') }}" method="post">
            @csrf
            @method('PUT')
            <div class="input-container">
                <label for="current_password">current password</label>
                <input type="password" id="current_password" name="current_password">
            </div>

            <div class="input-container">
                <label for="new_password">new password</label>
                <input type="password" id="new_password" name="new_password">
            </div>
            <div class="input-container">
                <label for="new_password_confirmation">confirm new password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation">
            </div>
            <button class="mt-10" type="submit">change password</button>
        </form>
    </div>
    <div class="container mb-20">
        <div class="info-wrapper float-right">
            <div class="info-folder">
                <div class="info-icon">?</div>
                <div class="info-message">To change your PIN, simply enter your current PIN in the corresponding field
                    and then enter a new PIN.</div>
            </div>
        </div>
        <div class="subtitle text-primary mb-10">Change PIN</div>
        <form action="{{ route('put.changepin') }}" method="post">
            @csrf
            @method('PUT')
            <div class="input-container">
                <label for="current_pin">current PIN</label>
                <input type="password" id="current_pin" name="current_pin" maxlength="6">
            </div>

            <div class="input-container">
                <label for="new_pin">new PIN</label>
                <input type="password" id="new_pin" name="new_pin" maxlength="6">
            </div>

            <div class="input-container">
                <label for="new_pin_confirmation">confirm new PIN</label>
                <input type="password" id="new_pin_confirmation" name="new_pin_confirmation" maxlength="6">
            </div>
            <button class="mt-10" type="submit">change PIN</button>
        </form>
    </div>
    <div class="container mb-20">
        <div class="info-wrapper float-right">
            <div class="info-folder">
                <div class="info-icon">?</div>
                <div class="info-message">All market prices will be displayed according to the chosen currency.</div>
            </div>
        </div>
        <div class="subtitle text-primary mb-10">Local currency</div>
        <form action="{{ route('post.changecurrency') }}" method="post">
            @csrf
            <select id="currency" name="currency" class="dropdown-wrapper">
                @foreach(config('currencies') as $currency)
                <option value="{{ $currency }}" @if($currency==auth()->user()->currency) selected @endif>{{ $currency }}
                </option>
                @endforeach
            </select>
            <button type="submit">change</button>
        </form>
    </div>
    <div class="container mb-20">
        <div class="subtitle text-primary mb-10 inblock">Backup wallet</div>
        <div class="info-wrapper float-right">
            <div class="info-folder">
                <div class="info-icon">?</div>
                <div class="info-message">If for some reason this site has to be shut down unexpectedly, the available
                    moneros in your account will be sent here.</div>
            </div>
        </div>
        <form action="{{ route('put.changebackupwallet') }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="input-container">
                    <label for="monero_wallet_address">monero wallet address</label>
                    <input type="text" id="monero_wallet_address" name="monero_wallet_address"
                        value="{{ auth()->user()->backup_monero_wallet }}" maxlenght="35">
                </div>
                <button class="mt-10" type="submit">change</button>
            </div>
        </form>
    </div>
    <div class="container" id="pgpkey">
        <div class="subtitle text-primary mb-10 inblock">Change PGP key</div>
        <div class="description inblock"><a href="{{ route('pgpkey') }}" target="__blank">➜ see
                your current PGP key</a></div>
        <div class="info-wrapper float-right">
            <div class="info-folder">
                <div class="info-icon">?</div>
                <div class="info-message">A message will be encrypted with the PGP key entered. You will have to decrypt
                    it and paste the verification code to confirm the PGP key change.</div>
            </div>
        </div>
        @if(!session()->has('verification_name') and session()->get('verification_name') !== 'confirm_new_pgp_key')
        <form action="{{ route('post.changepgpkey') }}" method="post">
            @csrf
            <div class="input-container">
                <label for="pgp_key">PGP key</label>
                <textarea id="pgp_key" name="pgp_key" cols="50" rows="12"></textarea>
            </div>

            <button class="mt-10" type="submit">next step</button>
        </form>
        @else
        <form action="{{ route('put.changepgpkey') }}" method="post">
            @csrf
            @method('PUT')
            <div class="input-container">
                <label>Encrypted message</label>
                <textarea cols="50" rows="12" disabled>{{ session()->get('encrypted_message') }}</textarea>
            </div>
            <div class="description mt-10">Decrypt the above message with the PGP key entered and copy and paste<br>the
                verification code into the field below.</div>
            <div class="input-container mt-10">
                <label for="verification_code">Verification code</label>
                <input type="text" id="verification_code" name="verification_code">
            </div>
            <div class="mt-10">
                <a href="{{ route('cancelpgpkeychange') }}"><button>Cancel</button>  </a>
                <button class="mt-10" type="submit">Confirm and change</button>
            </div>
        </form>
        @endif
    </div>
</div>

@stop