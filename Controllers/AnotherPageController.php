<?php
namespace App\Controllers;

use App\Core\Controller;

class AnotherPageController extends Controller
{
    /*
    * return view
    */
    public function index()
    {
        return $this->view('anotherPage', ['name' => 'MVC template']);
    }
}