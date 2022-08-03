<div class="form-group">
	<div class="captcha" style=margin-bottom:5px;>
	{!! Captcha::img() !!} 
	</div>
	<input type="text" id="captcha" name="captcha" placeholder="Enter Captcha">
	<button type="submit" style=background-color:#5865F2;border:none;>Go</button> 
	@error('captcha')
	<div class="error">
		<small class="text-danger">{{ $errors->first('captcha') }}</small>
	</div>
	@enderror
</div>