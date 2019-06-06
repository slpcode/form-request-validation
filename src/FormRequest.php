<?php

namespace Slpcode\FormRequestValidation;

use Slpcode\FormRequestValidation\Exceptions\ValidationException;
use Symfony\Component\HttpFoundation\ParameterBag;

class FormRequest extends Request
{
    protected $translation_path = __DIR__ . '/lang';
    protected $translation_locale = 'zh-CN';

    /**
     * 构造初始化
     *
     * FormRequest constructor.
     * @param array $attributeData
     */
    public function __construct($attributeData = [])
    {
        parent::__construct($_GET, $_POST, $attributeData, $_COOKIE, $_FILES, $_SERVER);

        /**
         * 判断是否符合传递body数据,例如json形式数据，如果符合则重新赋值$this->request
         */
        if (0 === strpos($this->headers->get('CONTENT_TYPE'), 'application/x-www-form-urlencoded')
            && \in_array(strtoupper($this->server->get('REQUEST_METHOD', 'GET')), ['PUT', 'DELETE', 'PATCH'])
        ) {
            parse_str($this->getContent(), $data);
            $this->request = new ParameterBag($data);
        }

        // 扩展验证
        $this->extend();
    }

    /**
     * 设置语言和路径
     *
     * @param string $locale
     * @param string $path
     * @return FormRequest
     */
    public function setLang($locale = 'zh-CN', $path = '')
    {
        if ($path) {
            $this->translation_path = $path;
        }
        if ($locale) {
            $this->translation_locale = $locale;
        }

        return $this;
    }

    /**
     * 获取验证实例
     */
    public function getValidator()
    {
        return Validator::getInstance($this->translation_locale, $this->translation_path);
    }

    /**
     * @return FormRequest
     * @throws \Exception
     */
    public function check()
    {
        return $this->verify();
    }

    /**
     * 创建验证对象
     *
     * @return \Illuminate\Validation\Validator
     */
    public function make()
    {
        return $this->getValidator()->make(
            $this->validationData(),
            $this->rules(),
            $this->messages(),
            $this->attributes()
        );
    }

    /**
     * 进行验证
     *
     * @throws \Exception
     */
    protected function verify()
    {
        $validatorObj = $this->make();

        if ($validatorObj->fails()) {
            throw new ValidationException($validatorObj->messages()->first());
        }

        return $this;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->all();
    }

    /**
     * 设置验证规则
     *
     * @return array
     */
    protected function rules()
    {
        return [];
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

    /**
     * 扩展验证
     */
    protected function extend()
    {
        return $this;
    }
}