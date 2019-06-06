<?php
require_once '../vendor/autoload.php';

require_once 'request/TestRequest.php';

//$validator = \Slpcode\FormRequestValidation\Validator::getInstance();
//
//$validation = $validator->make(['name' => 'teaaast'], ['name' => 'required|max:5']);
//dd($validation, $validation->messages());

//dd($validator);

$request = new TestRequest;

$result = $request->make();

dd($result->errors());