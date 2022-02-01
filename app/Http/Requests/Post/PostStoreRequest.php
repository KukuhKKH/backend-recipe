<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|max:255|unique:posts,title',
            'sub_title' => 'required|max:255',
            'time' => 'required|max:255',
            'time_unit' => 'required|max:255',
            'total' => 'required|max:255',
            'total_unit' => 'required|max:255',
            'level' => 'required|numeric|in:1,2,3,4,5',
            'image' => 'required|file|mimes:png,jpg,jpeg,gif|max:2048',
        ];
    }
}
