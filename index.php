<?php

use Core\Router;
use Core\Request;

require_once 'vendor/autoload.php';
require_once 'core/helper/helperFunctions.php';

try {
    Router::init("app/routes.php")::direct(new Request());
} catch (Exception $e) {
    echo $e->getMessage();
}
