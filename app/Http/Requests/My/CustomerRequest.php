<?php

namespace App\Http\Requests\My;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
            'address' => 'required',
            'id_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên khách không được rỗng',
            'phone.required' => 'SĐT khách không được rỗng',
            'email.required' => 'Email khách không được rỗng',
            'id_number.required' => 'Số CMT khách không được rỗng',
            'address.required' => 'Địa chỉ không được rỗng',
        ];
    }
}
