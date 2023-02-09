<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class products extends FormRequest
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
            "category_id"=>'required',
            "subcategory_id"=>'required',
            "product_name"=>'required|unique:product_name',
            "product_price"=>'required|unique:product_price',
            "product_description"=>'required|unique:product_description',
            "product_photo"=>'required|unique:product_photo',
        ];
    }
}
