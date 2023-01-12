<?php
use App\Core\Controller;

class ErrorController extends Controller
{
    /*
    * return view
    */
    public function index($errorNumber)
    {
        return $this->view('Error/error', ['errNbr' => $errorNumber]);
    }
}