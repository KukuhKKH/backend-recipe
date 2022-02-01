<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $rule = [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . request()->user,
            'username' => 'required|unique:users,username,' . request()->user,
            'password_old' => 'nullable|min:6',
            'password' => 'nullable|min:6|confirmed',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,gif|max:2048'
        ];
        if(request()->password_old != null) {
            $rule['password'] = "required|min:6|confirmed";
        }
        return $rule;
    }
}
