<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {

    $breadcrum = (object) [
        'title' => 'selamat datang di website kami',
        'list' => ['home', 'welcome']
    ];

    $activemenu = 'dashboard';
    
        return view('welcome', ['breadcrum' => $breadcrum, 'activemenu' => $activemenu]);
    }
}
