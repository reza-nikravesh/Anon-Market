@extends('master.main')

@section('title', 'Account index')
@include('includes.flash.validation')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menuaccount')
<div class="content-profile">
    <div class="container container-md">
        <div class="title text-primary">Useful information</div>
        <h3 class="description">These are some information you need to know about the market. Always refer to these
            notes before opening a help request.
        </h3>
        <ul class=" description list-style-disc list-indent">
            <li>If you place an order and do not pay within 2 days, the order is automatically canceled and any money
                placed in the custody wallet is refunded.</li>
            <li>Orders marked as canceled or delivered will be deleted within 7 days.</li>
            <li>All your conversations and messages are automatically deleted after 30 days.</li>
            <li>Orders with shipped status are finalized after 30 days.</li>
            <li>Help requests marked as closed are deleted after 30 days.</li>
        </ul>
        <span class="description">If you want to get more information about how the market works and how to use it, see
            the </span><a href="{{ config('general.wiki_link') }}" target="_blank"><strong>wiki</strong></a>.
    </div>
</div>

@stop