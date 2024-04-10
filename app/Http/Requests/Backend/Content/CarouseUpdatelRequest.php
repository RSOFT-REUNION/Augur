<?php

namespace App\Http\Requests\Backend\Content;

use Illuminate\Foundation\Http\FormRequest;

class CarouseUpdatelRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'string|max:255|nullable',
            'title_url' => 'string|max:255|nullable',
            'url' => 'string|max:255|nullable',
            ];
    }
}
