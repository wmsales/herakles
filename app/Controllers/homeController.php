<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('setup/home', ['title' => 'Welcome to Herakles']);
    }
}
