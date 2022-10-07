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
        return $this->offlineView('anotherPage', [
            'name' => 'MVC template XXX',
            'page' => $this->pageNumber($pageNbr)
        ]);
    }
}