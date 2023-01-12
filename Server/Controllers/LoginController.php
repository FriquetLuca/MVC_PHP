<?php
use App\Core\Controller;

class LoginController extends Controller
{
    /*
    * return view
    */
    public function index()
    {
        return $this->view('Login/login', []);
    }
}