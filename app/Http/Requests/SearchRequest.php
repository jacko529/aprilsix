<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class SearchRequest extends FormRequest
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
            'search' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'search.required' => 'Search Query String Is Required',
            'search.string' => 'Search Query String Must Be A String',
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        return back()->withErrors($validator->errors());

    }
}
