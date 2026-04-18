<?php

namespace App\Http\Controllers;

use App\Models\usermodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPage extends Controller
{
    public function index(){

    $user = usermodel::Create(
      [
        'user_nama' => 'manager45',
        'nama' => 'managerempat',
        'password' => hash::make('123456'),
        'level_id' => 2
      ]
    );

    $user->user_nama = 'manager46';

$user->isDirty(); // true
$user->isDirty('user_nama'); // true
$user->isDirty('nama'); // false
$user->isDirty(['nama', 'user_nama']); // true

$user->isClean(); // false
$user->isClean('user_nama'); // false
$user->isClean('nama'); // true
$user->isClean(['nama', 'user_nama']); // false

$user->save();

$user->isDirty(); // false
$user->isClean(); // true
dd($user->isDyrty());


        $user = UserModel::create([
            'user_nama' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        // ubah data
        $user->user_nama = 'manager12';

        // simpan perubahan
        $user->save();

        // cek perubahan setelah save
        $user->wasChanged(); // true
        $user->wasChanged('user_nama'); // true
        $user->wasChanged(['user_nama', 'level_id']); // true
        $user->wasChanged('nama'); // false
        $user->wasChanged(['nama', 'user_nama']); // true
    

    }
}