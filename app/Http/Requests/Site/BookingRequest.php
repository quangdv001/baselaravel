<?php

namespace App\Http\Requests\Site;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'start_time' => 'required',
            'end_time' => 'required',
            'start_id' => 'required',
            'end_id' => 'required',
            'qty' => 'required',
            'phone' => ['required', new PhoneNumber()]
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
            'name.required' => 'Mời nhập tên',
            'start_time.required' => 'Mời chọn ngày đi',
            'end_time.required' => 'Mời chọn ngày về',
            'start_id.required' => 'Mời chọn điểm đi',
            'end_id.required' => 'Mời chọn điểm đến',
            'qty.required' => 'Mời nhập số lượng người',
            'phone.required' => 'Mời nhập SĐT',
            'email.required' => 'Mời nhập Email',
            'email.email'  => 'Email sai định dạng',
        ];
    }
}
