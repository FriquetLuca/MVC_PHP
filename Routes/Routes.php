<?php
namespace App\Routes;

use App\Routes\ViewsRoutes;
use App\Controllers\HomeController;
use App\Controllers\AnotherPageController;
use App\Controllers\ApiPageController;

$views = new ViewsRoutes([
    '/' => function() {
        (new HomeController)->index();
    },
    '/page(/\d+)?' => function($pageNbr) {
        (new AnotherPageController)->index($pageNbr);
    },
    '/api' => function() {
        (new ApiPageController)->index();
    }
]);
$views->start();