<div class="form-group">
    <div class="captcha" style=margin-bottom:5px;>
        {!! Captcha::img() !!}
    </div>
    <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha">
    @error('captcha')
    <div class="error">
        <small class="text-danger">{{ $errors->first('captcha') }}</small>
    </div>
    @enderror
    <div class='btn-submit'>
        <button type="submit" >Go</button>
       
    </div>
</div>