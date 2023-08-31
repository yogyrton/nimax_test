<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'Поле "name" обязательно',
            'name.string' => 'Поле "name" должно быть строкой',
            'name.min' => 'Поле "name" минимум 3 символа',
            'name.max' => 'Поле "name" максимум 100 символа',

        ];
    }
}
