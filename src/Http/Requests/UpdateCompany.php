<?php

namespace Betalabs\LaravelHelper\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompany extends FormRequest
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
            'name' => 'string|max:60',
            'trading_name' => 'string|max:60',
            'email' => 'email|max:80',
            'cnpj' => 'string|size:14',
        ];
    }
}
