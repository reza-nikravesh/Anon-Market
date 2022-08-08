@extends('master.main')

@section('title', 'Admin market settings')

@include('includes.flash.success')
@include('includes.flash.error')
@section('content')

@include('includes.components.menustaff')

<div class="content-profile">
    <div class="flex-row">
        <div class="box w-md text-center  ">
            <div>
                <span class="subtitle text-primary">Totall users</span>
                <div class="description mt-10">Currently the market has <strong>{{ $totalUsers }}</strong> users</div>

            </div>
        </div>
        <div class="box w-md text-center  ">
            <div>
                <span class="subtitle text-primary">Total sellers</span>
                <div class="description mt-10">Currently the market has {{ $totalSellers }} sellers</div>

            </div>
        </div>
        <div class="box w-md text-center  ">
            <div>
                <span class="subtitle text-primary">Total employees</span>
                <div class="description mt-10">Currently the market has {{ $totalEmployeers }} employees</div>

            </div>
        </div>
        <div class="box w-md text-center  ">
            <div>
                <span class="subtitle text-primary">Total products</span>
                <div class="description mt-10">Currently the market has <strong>{{ $totalProducts }}</strong> products
                </div>

            </div>
        </div>
        <div class="box w-md text-center  ">
            <div>
                <span class="subtitle text-primary">Total money (In XMR)</span>
                <div class="description mt-10">The market has {{ $totalMoneros }} moneros in their wallets</div>

            </div>
        </div>
    </div>

    <div class="box  mt-20">
       <div >
	   <div class="title text-primary mb-10">Market settings</div>
        <form action="{{ route('put.admin.dashboard') }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group">
				<div class="input-container ">
                    <label for="seller_fee">Fee to become a seller</label>
                    <input type="text" id="seller_fee" name="seller_fee" value="{{ $sellerFee }}">
                </div>
				</div>
                <div class="description">Set the amount the user will have to pay to become a seller</div>
                @error('seller_fee')
                <div class="error">
                    <small class="text-danger description">{{ $errors->first('seller_fee') }}</small>
                </div>
                @enderror
                <div class="input-container ">
                    <label for="seller_fee">Reddit forum</label>
                    <input type="text" id="reddit_forum_link" name="reddit_forum_link" value="{{ $redditForumLink }}">
                </div>
                <div class="description">Set reddit forum link</div>
                @error('reddit_forum_link')
                <div class="error">
                    <small class="text-danger description">{{ $errors->first('reddit_forum_link') }}</small>
                </div>
                @enderror
                <div class="input-container ">
                    <label for="seller_fee">Wiki</label>
                    <input type="text" id="wiki_link" name="wiki_link" value="{{ $wikiLink }}">
                </div>

                <div class="description">Set wiki link</div>
                @error('wiki_link')
                <div class="error">
                    <small class="text-danger description">{{ $errors->first('wiki_link') }}</small>
                </div>
                @enderror
            </div>
            <button class="mt-10" type="submit">Change settings</button>
        </form>
        <div class="info-wrapper   mt-40">
            <div class="info-folder">
                <div class="info-icon  text-error border-error bg-paper">?</div>
                <div class="info-message text-error border-error bg-paper">
                    <strong>This button is highly dangerous.</strong> If you click on it, money from the market is sent
                    to users' backup wallets. In addition to transferring all the money, this button will delete all
                    conversations and messages in the database.
                </div>
            </div>
        </div>
        <form action="{{ route('post.admin.exitbutton') }}" method="post" class="inblock">
            @csrf
            <button type="submit" class="button-danger">PANIC BUTTON</button>
        </form>
	   </div>
    </div>
</div>

@stop