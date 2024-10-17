<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:customers,email,' . $this->route('customer')->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'kyc_status' => 'nullable|string',
            'last_login' => 'nullable|date',
            'registered_at' => 'nullable|date',
        ];
    }
}
