@extends('master.main')

@section('title', 'Affiliate system')

@section('content')

@include('includes.components.menuaccount')
<div class="content-profile">
    <div class="title text-primary mb-15">Affiliate system</div>
    <div class="flashdata flashdata-success mb-10 subtitle-sm container-sm">You were referenced by:
        {{ !is_null($reference) ? $reference->username : 'no one'}}</div>
    <div class="container">
        <div class="  subtitle text-primary mb-10">Your referral link</div>
        <div class="input-container">
            <input class="bg-primary-dark" type="text" value="{{ route('register', ['reference' => auth()->user()->reference_code]) }}"
                disabled>
        </div>
        <div class="description mt-10">Share your referral link with your friends and earn a small commission for every
            purchase made by them.</div>
    </div>
</div>

@stop