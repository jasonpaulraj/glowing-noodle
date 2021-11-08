<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionBoxContentCreateRequest extends FormRequest
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
            'position' => 'required|string',
            'css_styling_code' => 'sometimes|string',
            'text_color' => 'sometimes|string',
            'position_box_text_id' => 'sometimes|string'
        ];
    }
}
