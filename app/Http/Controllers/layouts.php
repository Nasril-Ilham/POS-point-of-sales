<?php

namespace App\Http\Controllers;

use App\Models\usermodel;
use Illuminate\Http\Request;

class layouts extends Controller
{
  public function index()
{
    $image = usermodel::whereNotNull('image')->value('image');

    return view('layouts.sidebar', compact('image'));
}
}
