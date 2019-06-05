<?php

use Slpcode\FormRequestValidation\FormRequest;

/**
 * Created by PhpStorm.
 * User: tanbin
 * Date: 2019/6/5
 * Time: 15:01
 */

class TestRequest extends FormRequest
{
    /**
     * 设置验证规则
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => 'required|max:20',
            'age' => 'require|min:6'
        ];
    }

    /**
     * 设置验证错误信息
     *
     * @return array
     */
    protected function messages()
    {
        return [];
    }

    /**
     * 自定义字段名称
     *
     * @return array
     */
    protected function attributes()
    {
        return [];
    }
}