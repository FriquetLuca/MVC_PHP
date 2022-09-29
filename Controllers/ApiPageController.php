<?php
namespace App\Controllers;

use App\Core\Controller;

class ApiPageController extends Controller
{
    /*
    * return view
    */
    public function index()
    {
        return $this->view('apiPage', ['name' => 'Some name']);
    }
}