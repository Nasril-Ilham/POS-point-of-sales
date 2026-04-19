<?php

namespace App\Http\Controllers;

use App\Models\usermodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPage extends Controller
{
    public function index(){

    $user = usermodel::all();
    
    return view('user', ['data' => $user]);

    }

    public function tambah(){

    return view('user_tambah');
    }

    public function tambah_simpan(Request $request){

          usermodel::create([
           'user_nama' => $request->user_nama,
           'nama' => $request->nama,
           'password' => Hash::make($request->password),
           'level_id' => $request->level_id
          ]);

          return redirect('/user');
    }

    public function ubah($id){
      $user = usermodel::find($id);
      return view('user_ubah', ["data" => $user]);
    }


    public function change(Request $request, $id){
     $user = usermodel::find($id);

     $user->user_nama = $request->user_nama;
     $user->nama = $request->nama;
     $user->password = hash::make($request->password);
     $user->level_id = $request->level_id;

     $user->save();

     return redirect('/user');

    }

    public function delete($id){

     $user= usermodel::find($id);
     $user->delete();

     return redirect('/user');
    }
}