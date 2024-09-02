<?php

use Otaodev\Infra\HomeController;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$texto = (new HomeController())->index();

echo $texto;
