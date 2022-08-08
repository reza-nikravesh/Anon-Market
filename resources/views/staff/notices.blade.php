@extends('master.main')

@section('title', 'Staff notices')

@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')
<div class="content-profile">
    <div class="title text-primary">Add new notice</div>
    <div class="mt-10">
        <form action="{{ route('post.staff.addnotice') }}" method="post" class="mb-40">
            @csrf
            <div class="form-group">
                <div class="input-container w-50">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" >
                </div>
                <div class="error description">
                    @error('title')
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group mt-10">
                <div class="input-container">
                    <label for="notice">Notice</label>
                    <textarea id="notice" name="notice" cols="55" rows="20"></textarea>

                </div>
                <div class="notice">
                    @error('notice')
                    <small class="text-danger  description">{{ $errors->first('notice') }}</small>
                    @enderror
                </div>
            </div>
            <button class="submit mt-10">Submit</button>
        </form>
    </div>
    <div class="subtitle text-primary mb-10">All notices ({{ $notices->count() }})</div>
    <div class="flex-row overflow-x-scroll">
		 <table class="zebra table-space">
        <thead class="subtitle-sm text-secondary">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody class="description">
            @forelse($notices as $notice)
            <tr>
                <td><a href="{{ route('notice', ['notice' => $notice->id]) }}">{{ $notice->title }}</a></td>
                <td>{{ $notice->user->username }}</td>
                <td>{{ $notice->createdAt() }}</td>
                <td>{{ $notice->updatedAt() }}</td>
                <td>
                    <button><a href="{{ route('staff.notice', ['notice' => $notice->id]) }}"
                            class="button">Edit</a></button>
                    <form action="{{ route('delete.staff.notice', ['notice' => $notice->id]) }}" class="inblock"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button class="text-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">The market does not have any warnings yet!</td>
            </tr>
            @endforelse
            <tr>
                <td colspan="5">{{ $notices->links('includes.components.pagination') }}</td>
            </tr>
        </tbody>
    </table>
	</div>
   
</div>

@stop