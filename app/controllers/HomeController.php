<?php

namespace App\Controllers;
use Controller;

class HomeController extends Controller{
    public function index(){
        $this->view('Home');
    }

    public function create($request){
        $this->view('Test', $request);
    }
}