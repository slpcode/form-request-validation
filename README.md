form-request-validation
==========
form-request-validation 是一个不局限于框架的请求数据验证层，使用了illuminate/validation（laravel框架的验证模块）。
详细用法可查阅laravel文档 https://laravel.com/docs/5.4/validation#available-validation-rules。 
如果需要无依赖版，可以使用overtrue大神的 https://github.com/overtrue/validation
## Installing

```shell
$ composer require slpcode/form-request-validation -vvv
```

## FormRequest使用

```php
<?php

use Slpcode\FormRequestValidation\FormRequest;

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
            'age' => 'required|min:6'
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
```

```php
<?php 

// 进行验证，如果验证不通过则会抛出 Slpcode\FormRequestValidation\Exceptions\ValidationException 异常
// 通过后返回request实例

$request = (new TestRequest)->check();

```

## FormRequest扩展验证
```php
<?php
class BaseRequest extends \Slpcode\FormRequestValidation\FormRequest
{
    public function extend(){
        $this->getValidator()->extend('mobile', function ($attribute, $value, $parameters, $validator) {
//            return ...;
        }, ':attribute 格式不正确');
    }
}

```

## FormRequest自定义消息语言：
> 语言列表可以从这里拿：https://github.com/caouecs/Laravel-lang

```php
<?php
class BaseRequest extends \Slpcode\FormRequestValidation\FormRequest
{
    protected $translation_path = __DIR__ . '/lang';
    protected $translation_locale = 'en';
}

// 或
(new TestRequest)->setLang('en', '语言包路径');
```

## Validator 使用
```php
<?php

// 直接创建验证器对象的用法
$validator = \Slpcode\FormRequestValidation\Validator::getInstance();

//验证
$rules = [
    'name' => 'required|min:5|max:20',
    'age' => 'required|max:2',
    ///...
];
$data = [
    ///...
];
// 可选
// 自定义错误消息
$messages = [
    
    'name.required' => '名称不能为空',
    //...
]; 
// 可选
// 自定义属性名称
$attributes = [
    'name' => '用户名',
    'age' => '年龄',
];
$validatorObj = $validator->make($data, $rules, $messages, $attributes);
//判断验证是否通过
if ($validatorObj->fails()) {
   //未通过
   //输出错误消息
   dd($validatorObj->messages()->all());
} else {
    
}
```

## Validator扩展验证
```php
<?php
$validator = \Slpcode\FormRequestValidation\Validator::getInstance();
$validator->extend(
    'mobile', 
    function ($attribute, $value, $parameters, $validator) {
//      return ...;
    }, ':attribute 格式不正确');

```

## Validator自定义消息语言：
> 语言列表可以从这里拿：https://github.com/caouecs/Laravel-lang

```php
<?php
// 内部有两种语言包 en 和 zh-CN
$validator = \Slpcode\FormRequestValidation\Validator::getInstance('en', '路径');
```

## License

MIT