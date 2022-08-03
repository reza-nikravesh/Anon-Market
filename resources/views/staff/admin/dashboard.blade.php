@extends('master.main')

@section('title', 'Admin market settings')

@section('content')

@include('includes.components.menustaff')

<div class="content-profile">
	@include('includes.flash.success')
	@include('includes.flash.error')
	<div class="row">
		<div class="container text-center inblock">
			<span class="h2">Totall users</span>
			<div class="footnote mt-10">Currently the market has <strong>{{ $totalUsers }}</strong> users</div>
		</div>
		<div class="container text-center inblock">
			<span class="h2">Total sellers</span>
			<div class="footnote mt-10">Currently the market has {{ $totalSellers }} sellers</div>
		</div>
		<div class="container text-center inblock">
			<span class="h2">Total employees</span>
			<div class="footnote mt-10">Currently the market has {{ $totalEmployeers }} employees</div>
		</div>
	</div>
	<div class="row mt-10">
		<div class="container text-center inblock">
			<span class="h2">Total products</span>
			<div class="footnote mt-10">Currently the market has <strong>{{ $totalProducts }}</strong> products</div>
		</div>
		<div class="container text-center inblock">
			<span class="h2">Total money (In XMR)</span>
			<div class="footnote mt-10">The market has {{ $totalMoneros }} moneros in their wallets</div>
		</div>
	</div>
	<div class="container mt-20">
		<div class="h3 mb-10">Market settings</div>
		<form action="{{ route('put.admin.dashboard') }}" method="post">
			@csrf
			@method('PUT')
			<div class="form-group">
				<div class="label">
					<label for="seller_fee">Fee to become a seller</label>
				</div>
				<input type="text" id="seller_fee" name="seller_fee" value="{{ $sellerFee }}">
				<div class="footnote">Set the amount the user will have to pay to become a seller</div>
				@error('seller_fee')
				<div class="error">
					<small class="text-danger">{{ $errors->first('seller_fee') }}</small>
				</div>
				@enderror
				<div class="label">
					<label for="seller_fee">Reddit forum</label>
				</div>
				<input type="text" id="reddit_forum_link" name="reddit_forum_link" value="{{ $redditForumLink }}">
				<div class="footnote">Set reddit forum link</div>
				@error('reddit_forum_link')
				<div class="error">
					<small class="text-danger">{{ $errors->first('reddit_forum_link') }}</small>
				</div>
				@enderror
				<div class="label">
					<label for="seller_fee">Wiki</label>
				</div>
				<input type="text" id="wiki_link" name="wiki_link" value="{{ $wikiLink }}">
				<div class="footnote">Set wiki link</div>
				@error('wiki_link')
				<div class="error">
					<small class="text-danger">{{ $errors->first('wiki_link') }}</small>
				</div>
				@enderror
			</div>
			<button type="submit">Change settings</button>
		</form>
		<div class="info-wrapper inblock mt-40">
			<div class="info-folder">
				<div class="info-icon" style="color: #E80000; border-color: #E80000; background-color: #FFE3E3">?</div>
				<div class="info-message" style="color: #E80000; border-color: #E80000; background-color: #FFE3E3"><strong>This button is highly dangerous.</strong> If you click on it, money from the market is sent to users' backup wallets. In addition to transferring all the money, this button will delete all conversations and messages in the database.</div>
			</div>
		</div>
		<form action="{{ route('post.admin.exitbutton') }}" method="post" class="inblock">
			@csrf
			<button type="submit" class="button-danger">PANIC BUTTON</button>
		</form>
	</div>
</div>

@stop
