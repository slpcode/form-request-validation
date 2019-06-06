<?php

/*
 * This file is part of the slpcode/form-request-validation.
 *
 * (c) slpcode <1370808424@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Slpcode\FormRequestValidation\FormRequest;

class TestRequest extends FormRequest
{
    /**
     * 设置验证规则.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => 'required|max:20',
            'age' => 'required|min:6',
        ];
    }

    /**
     * 设置验证错误信息.
     *
     * @return array
     */
    protected function messages()
    {
        return [];
    }

    /**
     * 自定义字段名称.
     *
     * @return array
     */
    protected function attributes()
    {
        return [];
    }
}
