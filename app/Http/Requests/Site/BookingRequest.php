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
            'name.required' => 'Mời nhập tên(please insert your Name. Thank you!)',
            'start_time.required' => 'Mời chọn ngày đi(please select Departure date. Thank you!)',
            'start_id.required' => 'Mời chọn điểm đi(please select your departure point. Thank you!)',
            'end_id.required' => 'Mời chọn điểm đến(please select your departure point. Thank you!)',
            'qty.required' => 'Mời nhập số lượng người(please insert numbers of people. Thank you!)',
            'phone.required' => 'Mời nhập SĐT(please insert your telephone number. Thank you!)',
            'email.required' => 'Mời nhập Email(please insert your email. Thank you!)',
            'email.email'  => 'Email sai định dạng(Email incorrect!)',
        ];
    }
}
