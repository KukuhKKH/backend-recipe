<?php

namespace App\Http\Requests\Step;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateStepDetailRequest extends FormRequest
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
            'id' => 'nullable',
            'content' => 'required',
            'post_id' => 'required|numeric'
        ];
    }
}
