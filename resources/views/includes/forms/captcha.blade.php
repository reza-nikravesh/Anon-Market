<div class="form-group">
    <div class="captcha mb-10">
        {!! Captcha::img() !!}
    </div>
    <div class="input-container ">
        <input class="mb-10" type="text" id="captcha" name="captcha" placeholder="Enter Captcha">
        @error('captcha')
        <div class="error mb-10">
            <small class="text-danger description">{{ $errors->first('captcha') }}</small>
        </div>
        @enderror
    </div>
    <div class='btn-submit'>
        <button type="submit">Go</button>

    </div>
</div>