<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class kategoricontroller extends Controller
{
    public function index(){

    // masukkan data
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'snack/makanan ringan',
        //     'created_at' => now()
        // ];

        // DB::table('m_kategori')->insert($data);
        // return 'data bserhasil di masukkan';

    // update data
        // $rows = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'cemilan']);
        // return 'data sudah terupdate. jumlah data yang di update' . $rows . 'baris';

     // delete data
    //    $rows = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
    //    return 'data sudah terhapus.jumlah data yang terhapus ' .$rows . 'baris'; 

    // return di blade 

    $data = DB::table('m_kategori')->get();
    return view('kategori', ['data' => $data]);
    }
}
