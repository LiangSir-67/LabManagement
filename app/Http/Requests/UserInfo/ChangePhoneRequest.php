<?php

namespace App\Http\Requests\UserInfo;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePhoneRequest extends FormRequest
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
            'work_id' => 'required | numeric',
            'old_phone' => 'required | regex:/^1[123456789]{1}\d{9}$/',
            'new_phone' => 'required | regex:/^1[123456789]{1}\d{9}$/'
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail('参数错误!', $validator->errors()->all(), 422)));
    }
}
