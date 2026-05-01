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
                $btn  = '<a href="'.url('/stok/'.$row->stok_id).'" class="btn btn-sm btn-info">Detail</a> ';
                $btn .= '<a href="'.url('/stok/'.$row->stok_id.'/edit').'" class="btn btn-sm btn-primary">Edit</a> ';
                $btn .= '<form action="'.url('/stok/'.$row->stok_id).'" method="POST" style="display:inline-block;">
                            ' . csrf_field() . ' ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</button>
                         </form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

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
}
