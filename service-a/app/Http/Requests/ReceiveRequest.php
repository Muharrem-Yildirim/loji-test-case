<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiveRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => ['string', 'max:255', 'min:1'],
            'trace_id' => ['required', 'string', 'uuid'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'trace_id' => $this->headers->get('X-Trace-ID'),
        ]);
    }
}
