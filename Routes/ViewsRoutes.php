<?php
namespace App\Routes;
use Bramus\Router\Router;

class ViewsRoutes {
    private $getViews;
    private $views;
    public function __construct($getViews = []) {
        $this->usage = false;
        $this->getViews = $getViews;
    }
    public function start() {
        $router = new Router();
        foreach($this->getViews as $path => $exec) {
            $router->get($path, $exec);
        }
        $router->run();
    }
}