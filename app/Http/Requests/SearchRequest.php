<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\InvalidParameterException;

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

    /**
     * @param Validator $validator
     * @throws InvalidParameterException
     */
    protected function failedValidation(Validator $validator)
    {

        throw new InvalidParameterException($validator->errors()->first());

    }
}
