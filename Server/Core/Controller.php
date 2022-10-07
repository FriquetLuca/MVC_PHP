<?php 

namespace App\Core;
class Controller 
{
    protected function isConnected() {
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
            $isConnected = true;
        }
        if(!isset($_SESSION)) {
            $isConnected = false;
            session_destroy();
        }
        return $isConnected;
    }
    protected function pageNumber($pageNbr) {
        if(!isset($pageNbr)) {
            return 1;
        }
        return $pageNbr <= 0 ? 1 : $pageNbr;
    }
    public function view($view, $data = []) {
        $data['_CONNECTED'] = $this->isConnected();
        extract($data); 
        require_once(__VIEW__ . '/' . $view . '.php');
    }
    public function api($view, $data = []) {
        $this->view("API/$view", $data);
    }
    public function offlineView($view, $data = []) {
        $this->view("Offline/$view", $data);
    }
    public function onlineView($view, $data = []) {
        $connected = $this->isConnected();
        $data['_CONNECTED'] = $connected;
        extract($data); 
        if($connected) {
            require_once(__VIEW__ . '/Online/' . $view . '.php');
        } else {
            require_once(__VIEW__ . '/Offline/home.php');
        }
    }
}