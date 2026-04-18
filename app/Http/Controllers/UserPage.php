<?php

namespace App\Http\Controllers;

use App\Models\usermodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPage extends Controller
{
    public function index(){

    // firstorcrate : mengambil dari dtabase jika tidak ada di databse maka akan membuat baru 

    // mengambil data atau membuat jika tidak ada 
    $user = usermodel::firstOrCreate(
      [
         'user_nama' => 'manager',
         'nama' => 'manager',
      ]
    );

    $user = usermodel::firstOrCreate(
      [
         'user_nama' => 'manager2',
         'nama' => 'manager dua dua',
         'password' => Hash::make('12345'),
         'level_id' => 2 ,
      ]
    );

    // tanpa save() tidak akan ke simppan dalam sql
      $user = usermodel::firstOrNew(
      [
        'user_nama' => 'manager33',
        'nama' => 'managertiga tiga tiga',
        'password' => hash::make('123456'),
        'level_id' => 2
      ]
    );


    $user = usermodel::firstOrNew(
      [
        'user_nama' => 'manager33',
        'nama' => 'managertiga tiga tiga',
        'password' => hash::make('123456'),
        'level_id' => 2
      ]
    );
    $user->save();

    return view('user', ['data' => $user]);
    }

}

// noted
// untuk firstorcreate tidak perlu save() agar bisa di kesimpin dalam sql
// sedangkan untuk firstornew perlu menggunakan save() untuk agar tersimpan dalam sql