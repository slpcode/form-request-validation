<?php

/*
 * This file is part of the slpcode/form-request-validation.
 *
 * (c) slpcode <1370808424@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Slpcode\FormRequestValidation;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

class Validator
{
    private static $validator = null;

    public static function getInstance($locale = 'zh-CN', $path = __DIR__.'/lang')
    {
        if (null === self::$validator) {
            $translation_file_loader = new FileLoader(new Filesystem(), $path);
            $translator = new Translator($translation_file_loader, $locale);
            self::$validator = new Factory($translator);
        }

        return self::$validator;
    }
}
