<?php

namespace App\Http\Requests\Backend\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class ShopsUpdateRequest extends FormRequest
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
            'title' => 'required|min:3|max:255|string',
            'adress' => 'nullable',
            'postal_code' => 'nullable',
            'city' => 'nullable',
            'description' => 'required|min:3|max:255|string',
            'schedules' => 'string',
            'available' => 'required|string',
        ];
    }
}
