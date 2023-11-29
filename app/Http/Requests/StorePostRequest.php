<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'post_views' => ['nullable', 'string'],
            'likes' => ['nullable', 'string'],
            'comments' => ['nullable', 'string'],
            'unlikes' => ['nullable', 'string'],
            'post_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg, svg'],

            'user_id' => ['required', 'exists:users']
        ];
    }
}
