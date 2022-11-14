<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Query;

class HomeController extends Controller
{
    /*
    * return view
    */
    public function index()
    {
        $db = new Query('cogip');
        return $this->offlineView('home', ['name' => 'MVC template']);
    }
}