<?php

namespace App\Http\Controllers;

use App\Models\usermodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPage extends Controller
{
    public function index(){
    
    // // menambhakan data 
    // $data =[
    //     'user_nama' => 'customer-1',
    //     'nama' => 'pelanggan',
    //     'password' => Hash::make('1234'),
    //     'level_id' => 3,
    // ];

    // usermodel::insert($data);

    // // update data 
    // $data = [
    //     'nama' => 'pelanggan pertama'
    // ];

    // usermodel::where('user_nama', 'customer-1')->update($data);

    

    // menambahkan data 

    // $data = [
    //     'level_id' => 2,
    //     'user_nama' => 'manager tiga',
    //     'nama' => 'manager 3',
    //     'password' => Hash::make('234856')
    // ];
    // usermodel::create($data);

    //  // akses semua data 
    //    $user = usermodel::all();
    //     return view('User', ['data' => $user]);


     // mengambil satu objek atau data 
  //  $user = usermodel::find(1);
  //  return view('User' , ['data' => $user]);


   // firstOrfail : jika tidak ada maka akan terlempar ke not found page 
   $user = usermodel::where('user_nama','manager9')->firstOrFail();
   return view('User' , ['data' => $user]);
}



}