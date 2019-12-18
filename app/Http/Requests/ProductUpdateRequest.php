<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2',
            'sell_price' => 'required|numeric|between:0,99999',
            'sell_quantity_base' => 'required|numeric|between:0,99999',
            'unit' => 'required',
            'product_type' => 'required|numeric|between:0,9999',
        ];
    }
}
