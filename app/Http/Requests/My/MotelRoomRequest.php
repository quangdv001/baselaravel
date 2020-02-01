<?php

namespace App\Http\Requests\My;

use Illuminate\Foundation\Http\FormRequest;

class MotelRoomRequest extends FormRequest
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
            'floor' => 'required|gt:0',
            'max' => 'required',
            'price' => 'required',
            'motel_id' => 'required|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhà trọ không được rỗng',
            'floor.gt' => 'Tầng > 0',
            'max.required' => 'Số người > 0',
            'price.required' => 'Địa chỉ không được rỗng',
            'motel_id.gt' => 'Chưa chọn nhà trọ',
        ];
    }
}
