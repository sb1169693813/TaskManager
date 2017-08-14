<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTaskRequest extends Request
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
            'name' => 'required|max:199',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '任务名称不能为空',
            'name.max' => '任务名称不能太长',
        ];
    }
}
