<div class="field">
    <div
        class="cf-turnstile"
        data-sitekey="{{ config('services.turnstile.site_key') }}"
        data-theme="light"
        aria-describedby="turnstile-help{{ $errors->has('cf-turnstile-response') ? ' turnstile-error' : '' }}"
    ></div>
    <p id="turnstile-help">Please verify that you are human before submitting.</p>
    @error('cf-turnstile-response')
        <p id="turnstile-error" class="field-error">{{ $message }}</p>
    @enderror
</div>

@once
    @push('scripts')
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endpush
@endonce
