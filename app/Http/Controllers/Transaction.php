<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transaction extends Controller
{
    public function index(){
        return view('transaction');
    }
}
