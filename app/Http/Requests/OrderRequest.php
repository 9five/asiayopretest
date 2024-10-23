<?php

namespace App\Http\Requests;

use App\Rules\OrderCurrencyUSDRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'id' => 'integer|required|unique:id',
            'name' => [
                'string|required|',
                'regex:/^[a-zA-Z\s]*$/',
                'not_regex:/\b[a-z]{1,19}/g',
            ],
            'address' => 'required',
            'address.city' => 'string|required',
            'address.district' => 'string|required',
            'address.street' => 'string|required',
            'price' => 'numeric|required|max:2000',
            'currency' => ['required|in:TWD,USD', new OrderCurrencyUSDRule],
        ];
    }

    public function message()
    {
        return [
            'id.required' => ['ID field is required'],
            'name.required' => ['Name field is required'],
            'name.regex' => ['Name contains non-English characters'],
            'name.not_regex' => ['Name is not capitalized'],
            'city.required' => ['City field is required'],
            'district.required' => ['District field is required'],
            'street.required' => ['Street field is required'],
            'price.required' => ['Price field is required'],
            'price.max' => ['Price is over 2000'],
            'currency.required' => ['Currency field is required'],
            'currency.in' => ['Currency format is wrong']
        ];
    }
}
