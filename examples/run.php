<?php

/*
 * This file is part of the slpcode/form-request-validation.
 *
 * (c) slpcode <1370808424@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

require_once '../vendor/autoload.php';

require_once 'request/TestRequest.php';

//$validator = \Slpcode\FormRequestValidation\Validator::getInstance();
//
//$validation = $validator->make(['name' => 'teaaast'], ['name' => 'required|max:5']);
//dd($validation, $validation->messages());

//dd($validator);

$request = new TestRequest();

$result = $request->make();

dd($result->errors());
