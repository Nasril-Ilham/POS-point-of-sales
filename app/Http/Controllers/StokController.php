<?php

namespace App\Http\Controllers;

use App\Models\stockmodel;
use App\Models\suppliermodel;
use App\Models\categorymodel;
use App\Models\usermodel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{
    public function index()
    {
        $breadcrum = (object) [
            'title' => 'Data Stok',
            'list' => ['home', 'stok']
        ];

        $_page = (object) [
            'title' => 'Data stok barang masuk',
        ];

        $activemenu = 'stok';
        $kategori = categorymodel::all();

        $stok = stockmodel::all();

        return view('stok.stok', ['breadcrum' => $breadcrum, 'page' => $_page, 'activemenu' => $activemenu, 'stok' => $stok, 'kategori' => $kategori]);
    }

    public function list(Request $request)
    {
        $stok = stockmodel::select('stok_id', 'supplier_id', 'kategori_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with('supplier', 'kategori', 'user');

        if($request->kategori_id){
            $stok->where('kategori_id', $request->kategori_id);
        }

        if($request->stok_id){
            $stok->where('stok_id', $request->stok_id);
        }

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('supplier', function($row){
                return $row->supplier->supplier_nama ?? '-';
            })
            ->addColumn('kategori', function($row){
                return $row->kategori->kategori_nama ?? '-';
            })
            ->addColumn('user', function($row){
                return $row->user->user_nama ?? '-';
            })
            ->addColumn('aksi', function($row){
            $btn = '<button onclick="modelAction(\''.url('/stok/'.$row->stok_id.'/show_ajax').'\')" class="btn btn-sm btn-primary">Detail</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/stok/'.$row->stok_id.'/edit_ajax').'\')" class="btn btn-sm btn-info">Edit</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/stok/'.$row->stok_id.'/confirmDeleteAjax').'\')" class="btn btn-sm btn-danger">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    // ini berada di blade stock untuk membuat form nama supplier, kategori, dan user
    public function create()
    {
        $breadcrum = (object) [
            'title' => 'Tambah Stok',
            'list' => ['home', 'stok', 'tambah']
        ];
        $page = (object) [
            'title' => 'Form tambah stok barang',
        ];
        $supplier = suppliermodel::all();
        $kategori = categorymodel::all();
        $user = usermodel::all();
        $activemenu = 'stok';
        return view('stok.create', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'supplier' => $supplier, 'kategori' => $kategori, 'user' => $user]);
    }

    // ini ada di form dan di action nya post dan logic di bawah ini di jalankan 
    // $request untuk menangkap data yang kita inputkan di form 

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|integer|exists:m_supplier,supplier_id',
            'kategori_id' => 'required|integer|exists:m_kategori,kategori_id',
            'user_id' => 'required|integer|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1'
        ]);

        stockmodel::create([
            'supplier_id' => $request->supplier_id,
            'kategori_id' => $request->kategori_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil ditambahkan');
    }

    // end dari pembuatan form tambah stok barang, selanjutnya untuk detail stok barang masuk

    public function show(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Detail Stok',
            'list' => ['home', 'stok', 'detail']
        ];
        $page = (object) [
            'title' => 'Detail stok barang',
        ];
        $stok = stockmodel::with('supplier', 'kategori', 'user')->findOrFail($id);
        $activemenu = 'stok';
        return view('stok.show', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'stok' => $stok]);
    }

    public function edit(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Edit Stok',
            'list' => ['home', 'stok', 'edit']
        ];
        $page = (object) [
            'title' => 'Form edit stok barang',
        ];
        $stok = stockmodel::findOrFail($id);
        $supplier = suppliermodel::all();
        $kategori = categorymodel::all();
        $user = usermodel::all();
        $activemenu = 'stok';
        return view('stok.edit', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'stok' => $stok, 'supplier' => $supplier, 'kategori' => $kategori, 'user' => $user]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_id' => 'required|integer|exists:m_supplier,supplier_id',
            'kategori_id' => 'required|integer|exists:m_kategori,kategori_id',
            'user_id' => 'required|integer|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1'
        ]);

        $stok = stockmodel::findOrFail($id);
        $stok->supplier_id = $request->supplier_id;
        $stok->kategori_id = $request->kategori_id;
        $stok->user_id = $request->user_id;
        $stok->stok_tanggal = $request->stok_tanggal;
        $stok->stok_jumlah = $request->stok_jumlah;
        $stok->save();

        return redirect('/stok')->with('success', 'Data stok berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $stok = stockmodel::findOrFail($id);
        try{
            stockmodel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        }catch(\Exception $e){
            return redirect('/stok')->with('error', 'Data stok tidak bisa dihapus');
        }
    }

    // ajax
    public function createAjax(){
        $supplier = suppliermodel::select('supplier_id', 'supplier_nama')->get();
        $kategori = categorymodel::all();
        $user = usermodel::all();
        return view('stok.create_ajax')->with('supplier', $supplier)->with('kategori', $kategori)->with('user', $user);   
    }

    public function storeAjax(Request $request){
        if ($request->ajax() || $request->wantsJson()){
            $rules = [
                'supplier_id' => 'required|integer|exists:m_supplier,supplier_id',
                'kategori_id' => 'required|integer|exists:m_kategori,kategori_id',
                'user_id' => 'required|integer|exists:m_user,user_id',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer|min:1'
            ];

            $validate = validator($request->all(), $rules);

            $stok = stockmodel::create([
                'supplier_id' => $request->supplier_id,
                'kategori_id' => $request->kategori_id,
                'user_id' => $request->user_id,
                'stok_tanggal' => $request->stok_tanggal,
                'stok_jumlah' => $request->stok_jumlah
            ]);

           return response()->json([
                'status' => true,
                'message' => 'Data supplier berhasil ditambahkan'
            ]);
        }
        return redirect('/');
    }

    public function showAjax(string $id){
        $stok = stockmodel::with('supplier', 'kategori', 'user')->findOrFail($id);
        return view('stok.show_ajax')->with('stok', $stok);
    }

    public function editAjax(string $id){
    $stok = stockmodel::findOrFail($id);
    return view('stok.edit_ajax')->with('stok', $stok);
   }

  public function updateAjax(Request $request, string $id) {
    // 1. Perbaikan Rules: Sesuaikan dengan field di tabel t_stok
    $rules = [
        'supplier_id'  => 'required|integer|exists:m_supplier,supplier_id',
        'kategori_id'  => 'required|integer|exists:m_kategori,kategori_id',
        'user_id'      => 'required|integer|exists:m_user,user_id',
        'stok_tanggal' => 'required|date',
        'stok_jumlah'  => 'required|numeric',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status'   => false,
            'message'  => 'Validasi gagal.',
            'msgField' => $validator->errors()
        ]);
    }

    // 2. Perbaikan Nama Model (Gunakan PascalCase: StockModel atau StokModel)
    // Pastikan nama model sesuai dengan file di folder Models Anda
    $stok = stockmodel::findOrFail($id); 
    
    if ($stok) {
        $stok->update($request->all());
        return response()->json([
            'status'  => true,
            'message' => 'Data stok berhasil diupdate'
        ]);
    }

    return response()->json([
        'status'  => false,
        'message' => 'Data tidak ditemukan'
    ]);
}
}
