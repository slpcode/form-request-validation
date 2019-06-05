<?php
require_once '../vendor/autoload.php';

require_once 'request/TestRequest.php';

$request = (new TestRequest)->check();

dd($request);