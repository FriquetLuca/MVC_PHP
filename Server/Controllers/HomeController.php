<?php
use App\Core\Controller;

class HomeController extends Controller
{
    /*
    * return view
    */
    public function index()
    {
        if($this->isConnected()) {
            // Suppose you're connected, redirect to some page
            return $this->view('Home/home', ['name' => 'MVC template']);
        } else {
            return $this->view('Home/home', ['name' => 'MVC template']);
        }
    }
}