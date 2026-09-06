<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $website = trim((string) $this->input('business_website'));

        if ($website !== '' && ! preg_match('~^[a-z][a-z0-9+.-]*://~i', $website)) {
            $website = 'https://'.$website;
        }

        $this->merge(['business_website' => $website ?: null]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:254'],
            'phone' => ['nullable', 'string', 'max:40'],
            'business_name' => ['required', 'string', 'max:160'],
            'business_website' => ['nullable', 'url:http,https', 'max:2048'],
            'business_type' => ['nullable', 'string', 'max:120'],
            'business_location' => ['nullable', 'string', 'max:160'],
            'friction_description' => ['required', 'string', 'max:5000'],
            'current_process' => ['required', 'string', 'max:5000'],
            'desired_improvement' => ['nullable', 'string', 'max:5000'],
            'additional_context' => ['nullable', 'string', 'max:5000'],
            'company_fax' => ['nullable', 'prohibited'],
            'cf-turnstile-response' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'cf-turnstile-response.required' => 'Please complete the verification before submitting.',
        ];
    }

    protected function getRedirectUrl(): string
    {
        return parent::getRedirectUrl().'#audit-intake';
    }
}
