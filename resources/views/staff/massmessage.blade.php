@extends('master.main')

@section('title', 'Staff mass message')

@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile">
    <div class="title text-primary">Send mass message</div>
    <form action="{{ route('post.staff.massmessage') }}" method="post">
        @csrf
        <div class="form-group">
            <div class="input-container  ">
                <label for="message">Message</label>
                <textarea id="message" name="message" cols="60" rows="15"></textarea>
            </div>
        </div>
        <div class="flex-row mt-10 description">
            <input type="checkbox" value="buyers" name="group[]">Buyers
            <input type="checkbox" value="sellers" name="group[]">Sellers
            <input type="checkbox" value="staff" name="group[]">Staff
        </div>
        <div class="mt-10">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

@stop