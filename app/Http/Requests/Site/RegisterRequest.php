<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:users',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email không được rỗng',
            'email.unique' => 'Email đã tồn tại',
            'name.required' => 'Tên không được rỗng',
            'phone.required' => 'SĐT không được rỗng',
            'password.required' => 'Mật khẩu không được rỗng',
        ];
    }
}
