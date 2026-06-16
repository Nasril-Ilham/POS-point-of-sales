<?php

namespace App\Http\Controllers;

abstract class Controller
{
       protected function response(
        string $message,
        mixed $data = null,
        int $status = 200
    ) {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }
}

// cara pake di atas

//  public function index()
//     {
//         $penjualan = penjualanmodel::all();

//         return $this->response(
//          // pertama menampung massage
//          'data tersampaikan'
//     
//          // menampung data
//          // $penjualan
//
//          // menampung code http
//          //  200 / 201 / 404
//         );

//     }
