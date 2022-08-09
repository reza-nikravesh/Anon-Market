@extends('master.main')

@section('title', 'Staff edit notice')
@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile">

    <div class="title text-primary mb-20">Notice: {{ $notice->title }}</div>
    <div>
        <form action="{{ route('put.staff.editnotice', ['notice' => $notice->id]) }}" method="post" class="mb-40">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="input-container w-50">
                    <label for="title">title</label>
                    <input type="text" id="title" name="title" maxlength="50" value="{{ $notice->title }}">
                </div>
                <div class="error">
                    @error('title')
                    <small class="text-danger description">{{ $errors->first('title') }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="input-container ">
                    <label for="notice">notice</label>
                    <textarea id="notice" name="notice" cols="55" rows="20">{{ $notice->notice }}</textarea>
                </div>
                <div class="notice">
                    @error('notice')
                    <small class="text-danger description">{{ $errors->first('notice') }}</small>
                    @enderror
                </div>
            </div>
            <button>
                <a href="{{ route('staff.notices') }}">back</a>
            </button>
            <button type="submit ">submit</button>
        </form>
    </div>
</div>

@stop