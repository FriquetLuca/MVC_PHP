<?php
namespace App\Routes;

use Bramus\Router\Router;
use App\Controllers\HomeController;
use App\Controllers\AnotherPageController;

$router = new Router();

$router->get('/', function() {
    (new HomeController)->index();
});
$router->get('/page', function() {
    (new AnotherPageController)->index();
});

$router->run();