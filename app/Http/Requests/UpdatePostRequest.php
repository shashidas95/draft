<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'post_content' => ['required', 'string'],
            'post_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg, svg', 'max:2048'],
            'views_count' => ['integer', 'min:0',]
        ];
    }
}
