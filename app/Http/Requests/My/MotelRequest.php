<?php

namespace App\Http\Requests\My;

use Illuminate\Foundation\Http\FormRequest;

class MotelRequest extends FormRequest
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
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhà trọ không được rỗng',
            'address.required' => 'Địa chỉ không được rỗng',
        ];
    }
}
