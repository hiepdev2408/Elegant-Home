<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'user_manual' => 'nullable|string',
            'sku' => 'required|string|max:255|unique:products,sku',
            'base_price' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lt:base_price',
            'img_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'product_galleries.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories' => 'required|array|exists:categories,id',

            'variants' => 'nullable|array',
            'variants.*.sku' => 'nullable|string|max:255|unique:variants,sku',
            'variants.*.price_modifier' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'nullable|integer|min:0',
            'variants.*.image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'variants.*.attributes' => 'nullable|array',
            'variants.*.attributes.*' => 'nullable|exists:attribute_values,id',


        ];
    }
    public function messages()
    {
        return [
            'sku.required' => 'Trường mã sản phẩm không được bỏ trống.',
            'base_price.required' => 'Trường giá  không được bỏ trống.',
            'categories.required' => 'Trường danh mục không được bỏ trống.',
        ];
    }
}
