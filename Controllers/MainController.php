<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function index()
    {
        // $this->render('main/index', [], 'home');
        $this->twig->display('main/index.html.twig');
    }
}