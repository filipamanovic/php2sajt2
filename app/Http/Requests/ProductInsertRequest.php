<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductInsertRequest extends FormRequest
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
            'productPrice' => 'required|regex:/^[1-9][\d]{0,3}$/',
            'productImage' => 'file|mimes:jpg,jpeg,gif,png|max:2000'
        ];
    }

    public function messages()
    {
        return [
            'price.regex' => 'Price is out of range',
            'productImage.mimes'  => 'Not allowed file format',
            'productImage.max' => 'Maximum size is 2MB'
        ];
    }
}
