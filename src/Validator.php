<?php

namespace Slpcode\FormRequestValidation;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

class Validator
{
    private static $validator = null;

    public static function getInstance($locale = 'zh-CN', $path = __DIR__ . '/lang')
    {
        if (self::$validator === null) {
            $translation_file_loader = new FileLoader(new Filesystem(), $path);
            $translator = new Translator($translation_file_loader, $locale);
            self::$validator = new Factory($translator);
        }

        return self::$validator;
    }
}