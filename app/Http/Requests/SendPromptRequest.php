<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendPromptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contact_id' => ['required', 'integer', 'exists:contacts,id'],
            'prompt_id'  => ['required', 'integer', 'exists:prompts,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'contact_id.required' => 'Please choose a contact first.',
            'prompt_id.required'  => 'Please choose a prompt first.',
        ];
    }
}