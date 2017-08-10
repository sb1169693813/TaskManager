<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProjectRequest extends Request
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
            'name' => 'required|unique:projects',
            'thumbnail' => 'image|dimensions:min_width=261,min_height=98'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '项目名称是必填的',
            'name.unique' => '很抱歉，这个项目名称已经被占用！',
            'thumbnail.image' => '请上传图片格式的文件',
            'thumbnail.dimensions' => '上传的图片尺寸过小，请至少是261x98',
        ];
    }
}
