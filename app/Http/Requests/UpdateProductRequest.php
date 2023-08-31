<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|min:3|max:100',
            'price' => 'required|integer|min:0|max:10000',
            'categories' => 'required|array|min:2|max:10',
            'categories.*' => ['required', Rule::exists(Category::class, 'id')],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "name" обязательно',
            'name.string' => 'Поле "name" должно быть строкой',
            'name.min' => 'Поле "name" минимум 3 символа',
            'name.max' => 'Поле "name" максимум 100 символа',

            'price.required' => 'Поле "price" обязательно',
            'price.string' => 'Поле "price" должно быть строкой',
            'price.decimal' => 'Поле "price" должно содержать два знака после точки',
            'price.min' => 'Цена поля "price" больше 0',
            'price.max' => 'Цена поля "price" меньше 10000',

            'categories.required' => 'Поле "categories" обязательно',
            'categories.array' => 'Поле "categories" должно быть массивом',
            'categories.min' => 'Поле "categories" должно содержать минимум 2 значения',
            'categories.max' => 'Поле "categories" должно содержать максимум 10 значений',

            'categories.*' => 'Поле "categories" должно быть integer и категория должна существовать',
        ];
    }
}
