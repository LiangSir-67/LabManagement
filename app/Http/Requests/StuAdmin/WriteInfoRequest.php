<?php

namespace App\Http\Requests\StuAdmin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WriteInfoRequest extends FormRequest
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
            'weeks' => 'required | integer',
            'professional_classes' => 'required',
            'student_name' => 'required',
            'number' => 'required | integer',
            'class_name' => 'required',
            'class_type' => 'required',
            'teacher_name' => 'required',
            'device_run_condition' => 'required',
            'note' => 'required'
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
