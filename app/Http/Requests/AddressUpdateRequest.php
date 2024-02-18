<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AddressUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'region' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'barangay' => ['required', 'string'],
            'street' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'int', 'min:4'],
        ];
    }
}
