<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class levelcontroller extends Controller
{
    public function index(){

    // insert data 
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?,?,?)', ['cus','pelanggan',now()]);

        // return 'insert data berhasil !';

    // update data 
    //   DB::update('update m_level set level_nama = ? where level_kode = ? ', ['customer' , 'cus']);

    //   return 'update data berhasil di lakukan !';

    // delete data
    //    DB::delete('delete from m_level where level_kode = ?' ,['cus']);

    //    return 'data sudah terhapsu';

    // memilih semua data dan return di balde
     $data = DB::select('select * from m_level');
     
    return view('level',['data' => $data]);

    }
}
