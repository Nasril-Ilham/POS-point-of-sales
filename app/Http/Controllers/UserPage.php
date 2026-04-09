<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPage extends Controller
{
    public function index(){
        return view('User');
    }

    public function show($id, $name){
        return view('User', compact('id', 'name'));
    }
}
