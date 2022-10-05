<?php
namespace App\Controllers;

use App\Core\Controller;

class AnotherPageController extends Controller
{
    /*
    * return view
    */
    public function index($pageNbr)
    {
        if(!isset($pageNbr)) {
            $pageNbr = 1;
        }
        return $this->view('anotherPage', ['name' => 'MVC template XXX', 'page' => $pageNbr]);
    }
}