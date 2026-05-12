<?php

namespace App\Http\Controllers;

use App\Models\barangmodel;
use App\Models\categorymodel;
use App\Models\PenjualanDetailmodel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class baragController extends Controller
{
    public function index(){
        $breadcrum = (object) [
            'title' => 'Data barang',
            'list' => ['home', 'barang']
        ];

        $_page = (object) [
            'title' => 'Data barang yang tersedia',
        ];

        $activemenu = 'barang';

         $barang = barangmodel::all();

        return view('barang.barang', ['breadcrum' => $breadcrum, 'page' => $_page, 'activemenu' => $activemenu, 'barang' => $barang]);
    }

    public function list(Request $request)
    {
        $barang = barangmodel::select('barang_id', 'barang_nama', 'kategori_id', 'barang_kode', 'harga_jual', 'harga_beli')
            ->with('kategori');

        if($request->barang_id){
            $barang->where('barang_id', $request->barang_id);
        }

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function($barang){
            $btn = '<button onclick="modelAction(\''.url('/barang/'.$barang->barang_id.'/show_ajax').'\')" class="btn btn-sm btn-primary">Detail</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/barang/'.$barang->barang_id.'/edit_ajax').'\')" class="btn btn-sm btn-info">Edit</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/barang/'.$barang->barang_id.'/confirmDeleteAjax').'\')" class="btn btn-sm btn-danger">Hapus</button>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create()
    {
        $breadcrum = (object) [
            'title' => 'Tambah barang',
            'list' => ['home', 'barang', 'tambah']
        ];
        $page = (object) [
            'title' => 'Form tambah barang',
        ];
        $kategori = categorymodel::all();
        $activemenu = 'barang';
        return view('barang.create', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'kategori' => $kategori]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:100|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:1000',
            'kategori_id' => 'required|integer',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer'
        ]);

        barangmodel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'kategori_id' => $request->kategori_id,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Detail barang',
            'list' => ['home', 'barang', 'detail']
        ];
        $page = (object) [
            'title' => 'Detail barang',
        ];
        $barang = barangmodel::with('kategori')->findOrFail($id);
        $activemenu = 'barang';
        return view('barang.show', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'barang' => $barang]);
    }

    public function edit(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Edit barang',
            'list' => ['home', 'barang', 'edit']
        ];
        $page = (object) [
            'title' => 'Form edit barang',
        ];
        $barang = barangmodel::findOrFail($id);
        $kategori = categorymodel::all();
        $activemenu = 'barang';
        return view('barang.edit', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'barang' => $barang, 'kategori' => $kategori]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:100|unique:m_barang,barang_kode,'.$id.',barang_id',
            'barang_nama' => 'required|string|max:1000',
            'kategori_id' => 'required|integer',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer'
        ]);

        $barang = barangmodel::findOrFail($id);
        $barang->barang_kode = $request->barang_kode;
        $barang->barang_nama = $request->barang_nama;
        $barang->kategori_id = $request->kategori_id;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_jual = $request->harga_jual;
        $barang->save();

        return redirect('/barang')->with('success', 'Data barang berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $barang = barangmodel::findOrFail($id);
        try{
            barangmodel::destroy($id);
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        }catch(\Exception $e){
            return redirect('/barang')->with('error', 'Data barang tidak bisa dihapus karena memiliki data transaksi');
        }
    }

    // ajax
        public function createAjax(){
            $kategori = categorymodel::select('kategori_id', 'kategori_nama')->get();
            return view('barang.create_ajax')->with('kategori', $kategori);
        }

        public function storeAjax(Request $request){
            $rules = [
                'barang_kode' => 'required|string|max:100|unique:m_barang,barang_kode',
                'barang_nama' => 'required|string|max:1000',
                'kategori_id' => 'required|integer',
                'harga_beli' => 'required|integer',
                'harga_jual' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            $barang = barangmodel::create([
                'barang_kode' => $request->barang_kode,
                'barang_nama' => $request->barang_nama,
                'kategori_id' => $request->kategori_id,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil ditambahkan'
            ]);

            return redirect('/barang'); 
        }

        public function showAjax(string $id)
        {
            $barang = barangmodel::findOrFail( $id );
            return view('barang.show_ajax')->with('barang', $barang);
        }

        public function editAjax(string $id){
    $barang = barangmodel::findOrFail($id);
    $kategori = categorymodel::all();
    return view('barang.edit_ajax', compact('barang', 'kategori'));
   }

    public function updateAjax(Request $request, string $id) {
    $rules = [
        'kategori_id' => 'required|integer',
        'barang_kode' => 'required|string|max:100|unique:m_barang,barang_kode,'.$id.',barang_id',
        'barang_nama' => 'required|string|max:1000',
        'harga_beli'  => 'required|integer',
        'harga_jual'  => 'required|integer'
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status'   => false,
            'message'  => 'Validasi gagal.',
            'msgField' => $validator->errors()
        ]);
    }

    $barang = barangmodel::findOrFail($id);
    if ($barang) {
        $barang->update($request->all());
        return response()->json([
            'status'  => true,
            'message' => 'Data barang berhasil diupdate'
        ]);
    }

    return response()->json([
        'status'  => false,
        'message' => 'Data tidak ditemukan'
    ]);
}


public function confirmDeleteAjax(string $id){
        $barang = barangmodel::findOrFail($id);
        return view('barang.confirm_ajax')->with('barang', $barang);
     }

     public function destroyAjax(string $id) {
    if (request()->ajax() || request()->wantsJson()) {
        try {
            $barang = BarangModel::findOrFail($id);
            $barang->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data barang tidak bisa dihapus karena masih terkait dengan data stok atau transaksi'
            ]);
        }
    }
    return redirect('/');
}
}
