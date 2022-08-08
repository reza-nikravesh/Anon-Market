@extends('master.main')

@section('title',  'Wiki')

@section('content')

<div class="flex-column m-auto">
   <div class="container  ">
      <p class="title text-primary">Kosmos Market Wiki</p> <br>
      <p class="description"><strong>Note:</strong> <i>This page is updated constantly. In other to provide you with the most accurate answers feel free to message one of our admins or moderators.</i></p>
      <p class="description"><i>Active Moderators this week: <strong>BlackBlade</strong>, <strong>Unfair</strong></i></p>

      <span class="subtitle text-primary mt-10">Topics</span>
      <ul class="mt-10 list-indent list-style-disc">
          <li><a href="/site-guide">How to use this site.</a></li>
          <li><a href="/returns">Refund Policy.</a></li>
          <li><a href="/privacy">Privacy Policy.</a></li>
          <li><a href="/scam-alerts">Scam alerts.</a></li>
          <li><a href="/alt-coins-guide">How to purchase with other crypto coins.</a></li>
      </ul>
   </div>
</div>

@stop