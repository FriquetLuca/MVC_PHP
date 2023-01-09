<?php 

namespace App\Core;

class Controller
{
    protected function isConnected() {
        $isConnected = false;
        if(session_status() != PHP_SESSION_ACTIVE) {
            ini_set('session.cookie_samesite', 'None');
            session_start();
            $isConnected = true;
        }
        if(!isset($_SESSION)) {
            $isConnected = false;
            session_destroy();
        }
        return $isConnected;
    }
    protected function view($viewName, $data = [], $template = "index") {
        $data['_CONNECTED'] = $this->isConnected();
        extract($data);
        require_once __VIEW__ . "Templates/Pages/$template.php";
    }
    protected function api($view, $data = []) {
        $data['_CONNECTED'] = $this->isConnected();
        extract($data);
        require_once __VIEW__ . "API/$view.php";
    }
}