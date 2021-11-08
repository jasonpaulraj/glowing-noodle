<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionBoxUpdateRequest extends FormRequest
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
            'box_rows' => 'required|numeric|digits_between:1,10',
            'box_columns' => 'required|numeric|digits_between:1,10',
            'visibility' => 'sometimes|boolean',
            'box_disable_rows' => 'sometimes|array',
            'box_disable_columns' => 'sometimes|array'
        ];
    }
}
