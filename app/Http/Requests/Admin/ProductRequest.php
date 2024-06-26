<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required',
            'brand'         => 'required',
            'category'      => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'sku'           => 'required',
            'status'        => 'required',
            'weight'        => 'required',
            'stock'         => 'required',
        ];
    }
}
