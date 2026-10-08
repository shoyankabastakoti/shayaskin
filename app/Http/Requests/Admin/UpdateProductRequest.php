<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage-products') ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'price' => ['required', 'integer', 'min:0'],
            'category' => ['required', 'in:skincare,makeup'],
            'skin_type' => ['required', 'in:oily,dry,combination,all'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
            'reviews' => ['nullable', 'integer', 'min:0'],
            'stock_quantity' => ['nullable', 'integer', 'min:0', 'max:4294967295'],
            'ingredients' => ['nullable', 'string', 'max:5000'],
            'how_to_use' => ['nullable', 'string', 'max:5000'],
            'benefits' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
