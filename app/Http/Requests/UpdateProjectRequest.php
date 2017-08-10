<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProjectRequest extends Request
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
            //'thumbnail' => 'image|dimensions:min_width=261,min_height=98'
        ];
    }

    public function messages()
    {
        return [
            'thumbnail.image' => '请上传图片格式的文件',
            'thumbnail.dimensions' => '上传的图片尺寸过小，请至少是261x98',
        ];
    }
}
