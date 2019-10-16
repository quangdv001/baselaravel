<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'slug' => 'required|unique:land,slug,'.$this->id,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Tên bài viết không được rỗng',
            'short_description.required' => 'Mô tả ngắn của bài viết không được rỗng',
            'description.required' => 'Nội dung của bài viết không được rỗng',
            'slug.unique' => 'Slug đã tồn tại',
        ];
    }
}
