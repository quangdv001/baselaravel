<?php

namespace App\Http\Requests\My;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'title' => 'required',
            'unit' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tên dịch vụ không được rỗng',
            'unit.required' => 'Đơn vị không được rỗng',
        ];
    }
}
