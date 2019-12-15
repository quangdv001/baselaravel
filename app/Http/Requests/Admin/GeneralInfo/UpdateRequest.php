<?php

namespace App\Http\Requests\Admin\GeneralInfo;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            'type' => 'in:0,1,2',
            'status' => 'in:0,1',
            'content' => 'required_if:type,0',
            'link' => 'required_if:type,1',
            'icon' => 'required_if:type,1',
            'img' => 'required_if:type,2',
        ];
    }


    /**
     * custom ajax request
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $json = [
            'success' => false,
            'message' => implode(' ', $validator->errors()->all())
        ];
        $response = response($json);
        throw (new ValidationException($validator, $response))->status(400);
    }
}
