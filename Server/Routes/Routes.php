<?php
namespace App\Routes;

use Dotenv\Dotenv;
use Bramus\Router\Router;

$dotenv = Dotenv::createImmutable(__ROOT__);
$dotenv->safeLoad();

foreach(glob(__ROOT__ . "/Server/Controllers/*") as $filename){
    include_once $filename;
}
$router = new Router();
foreach(glob(__ROOT__ . "/Server/Routes/Injected/*") as $filename){
    include_once $filename;
}
$router->run();