<?php

namespace App\Http\Requests\Admin;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'sometimes|required|unique:admin|min:4|max:100',
            'password' => 'sometimes|required|min:4',
            'email' => 'nullable|email',
            'phone' => new PhoneNumber()
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
            'username.required' => 'Tài khoản không được rỗng',
            'username.unique' => 'Tài khoản đã tồn tại',
            'username.max' => 'Tài khoản không quá 100 ký tự',
            'username.min' => 'Tài khoản không dưới 4 ký tự',
            'password.required'  => 'Mật khẩu không được rỗng',
            'password.min' => 'Mật khẩu không dưới 4 ký tự',
            'email.email'  => 'Email sai định dạng',
        ];
    }
}
