<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, maka redirect ke halaman home
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
        // Ambil input 'username' dari form, tapi petakan ke kolom 'user_nama' untuk database
        $credentials = [
            'user_nama' => $request->username, 
            'password'  => $request->password
        ];

        // pada logic di bawah ini Auth::attempt kita tidak perlu lagi hash pasword kita scara manual karna laravel sudah melakukan itu sendiri
        //  menggunakan password_verify() di dalam internal php 
        // syarat
        // Model Harus Authenticatable  class usermodel extends Authenticatable
        // password db harus sudah hash


            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status'   => true,
                    'message'  => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}