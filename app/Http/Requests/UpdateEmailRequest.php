<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "fname" => ['required', 'max:255', 'string'],
            "mname" => ['nullable', 'max:255', 'string'],
            "lname" => ['required', 'max:255', 'string'],
            "contact_number" => ['required', 'digits:11'],
            "sex" => ['required', 'max:255', 'string'],
            "street" => ['nullable', 'max:255', 'string'],
            "brgy" => ['required', 'max:255', 'string'],
            "municipality" => ['required', 'max:255', 'string'],
            "province" => ['required', 'max:255', 'string'],
            "email" => ['required', 'email', 'max:255'],
            "password" => ['required', 'confirmed'],
            "type" => ['required', 'integer'],
            "userId" => ['required', 'integer'],
            "clientId" => ['required', 'integer'],
        ];
    }
}
