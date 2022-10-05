<?php 

namespace App\Core;
class Controller 
{
    /*
    * @var $view, $data
    * return view
    */
    public function view($view, $data = [])
    {
        if(session_status() != PHP_SESSION_ACTIVE)
        {
            session_start();
            $isConnected = true;
        }
        if(!isset($_SESSION)) {
            $isConnected = false;
            session_destroy();
        }
        $data['isConnected'] = $isConnected;
        extract($data); 
        require_once(__ROOT__ . '/Views/' . $view . '.php');
    }
}