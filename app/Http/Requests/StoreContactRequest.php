<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(collect(['name', 'email', 'phone', 'business_name', 'message'])
            ->mapWithKeys(fn (string $field): array => [$field => is_string($this->input($field)) ? trim($this->input($field)) : $this->input($field)])
            ->all());
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:10000'],
            'company_fax' => ['nullable', 'prohibited'],
        ];
    }

    protected function getRedirectUrl(): string
    {
        return parent::getRedirectUrl().'#general-contact';
    }
}
