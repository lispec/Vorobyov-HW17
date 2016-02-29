<?php

require_once 'vendor/autoload.php';
require_once 'components/Router.php';
require_once 'components/UserSession.php';
require_once 'controllers/BaseController.php';
require_once 'components/Pagination.php';

require_once 'models/Picture.php';
require_once 'models/FileDB.php';

//
//spl_autoload_register(function($class) {
//    var_dump($class);
//    die;
//});
//
//$class = new MySuperClass();

$router = new Router($_SERVER['REQUEST_URI']);

if(!$router->handle()) {
    echo 'Path not found.';
}