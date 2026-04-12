<?php

namespace App\Http\Controllers;

use App\Models\usermodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPage extends Controller
{
    public function index(){
    
    // menambhakan data 
    $data =[
        'user_nama' => 'customer-1',
        'nama' => 'pelanggan',
        'password' => Hash::make('1234'),
        'level_id' => 3,
    ];

    usermodel::insert($data);

    // update data 
    $data = [
        'nama' => 'pelanggan pertama'
    ];

    usermodel::where('user_nama', 'customer-1')->update($data);

    // akses semua data 
       $user = usermodel::all();
        return view('User', ['data' => $user]);
    }

    
}
