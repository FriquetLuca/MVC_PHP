<?php
namespace App\Routes;
use Bramus\Router\Router;

class ViewsRoutes {
    private $getViews;
    private $postViews;
    private $views;
    public function __construct($getViews = [], $postViews = []) {
        $this->usage = false;
        $this->getViews = $getViews;
        $this->postViews = $postViews;
    }
    public function start($additionalRouting = null) {
        $router = new Router();
        foreach($this->getViews as $path => $exec) {
            $router->get($path, $exec);
        }
        foreach($this->postViews as $path => $exec) {
            $router->post($path, $exec);
        }
        if(isset($additionalRouting)) {
            $additionalRouting($router);
        }
        $router->run();
    }
}