<?php

namespace App\Http\Controllers;
use App\Models\supliermodel;
use App\Models\suppliermodel;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class SupliermodelController extends Controller
{
    public function index()
    {
        $breadcrum = (object) [
            'title' => 'Data suplier',
            'list' => ['home', 'suplier']
        ];
        $_page = (object) [
            'title' => 'Data suplier yang tersedia',
        ];
        $activemenu = 'supplier';
        return view('supplier.index', ['breadcrum' => $breadcrum, 'page' => $_page, 'activemenu' => $activemenu]);
    }

    public function list(Request $request)
    {
        $supplier = supliermodel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->with('stok');

        if($request->supplier_id){
            $supplier->where('supplier_id', $request->supplier_id);
        }

        return DataTables::of($supplier)
            ->addIndexColumn()
            ->addColumn('aksi', function($supplier){
            $btn = '<button onclick="modelAction(\''.url('/supplier/'.$supplier->supplier_id.'/show_ajax').'\')" class="btn btn-sm btn-primary">Detail</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/supplier/'.$supplier->supplier_id.'/edit_ajax').'\')" class="btn btn-sm btn-info">Edit</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/supplier/'.$supplier->supplier_id.'/confirmDeleteAjax').'\')" class="btn btn-sm btn-danger">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create()
    {
        $breadcrum = (object) [
            'title' => 'Tambah Data supplier',
            'list' => ['home', 'supplier', 'create']
        ];
        $_page = (object) [
            'title' => 'Form Tambah Data supplier',
        ];
        $activemenu = 'supplier';
        return view('supplier.create', ['breadcrum' => $breadcrum, 'page' => $_page, 'activemenu' => $activemenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_kode' => 'required|unique:m_supplier,supplier_kode',
            'supplier_nama' => 'required',
            'supplier_alamat' => 'required',
        ]);

        supliermodel::create([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_alamat' => $request->supplier_alamat,
        ]);

        return redirect('supplier')->with('success', 'Data supplier berhasil ditambahkan');
    }

    public function show($id)
    {
        $breadcrum = (object) [
            'title' => 'Detail Data supplier',
            'list' => ['home', 'supplier', 'detail']
        ];
        $_page = (object) [
            'title' => 'Detail Data supplier',
        ];
        $activemenu = 'supplier';
        $supplier = supliermodel::findOrFail($id);
        return view('supplier.show', ['breadcrum' => $breadcrum, 'page' => $_page, 'activemenu' => $activemenu, 'supplier' => $supplier]);
    }

    public function edit($id)
    {
        $breadcrum = (object) [
            'title' => 'Edit Data supplier',
            'list' => ['home', 'supplier', 'edit']
        ];
        $_page = (object) [
            'title' => 'Form Edit Data supplier',
        ];
        $activemenu = 'supplier';
        $supplier = supliermodel::findOrFail($id);
        return view('supplier.edit', ['breadcrum' => $breadcrum, 'page' => $_page, 'activemenu' => $activemenu, 'supplier' => $supplier]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_kode' => 'required|unique:m_supplier,supplier_kode,'.$id.',supplier_id',
            'supplier_nama' => 'required',
            'supplier_alamat' => 'required',
        ]);

        $supplier = supliermodel::findOrFail($id);
        $supplier->update([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_alamat' => $request->supplier_alamat,
        ]);

        return redirect('supplier')->with('success', 'Data supplier berhasil diupdate');
    }

    public function destroy($id)
    {
        $supplier = supliermodel::findOrFail($id);
        $supplier->delete();
        return redirect('supplier')->with('success', 'Data supplier berhasil dihapus');
    }

    // ajax
    public function createAjax(){
        $supplier = supliermodel::select('supplier_id', 'supplier_nama')->get();
        return view('supplier.create_ajax')->with('supplier', $supplier);
    }

    public function storeAjax(Request $request)
    {
       if($request->ajax() || $request->wantsJson()){
           $rules = [
            'supplier_kode' => 'required|string|max:100|unique:m_supplier,supplier_kode',
                'supplier_nama' => 'required|string|max:255',
                'supplier_alamat' => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            supliermodel::create([
                'supplier_kode' => $request->supplier_kode,
                'supplier_nama' => $request->supplier_nama,
                'supplier_alamat' => $request->supplier_alamat
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data supplier berhasil ditambahkan'
            ]);
        }
        return redirect ('/');
    }

    public function showAjax(string $id){
        $supplier = suppliermodel::findOrFail($id);
        return view('supplier.show_ajax')->with('supplier', $supplier);
    }

    public function editAjax(string $id){
    $supplier = supliermodel::findOrFail($id);
    return view('supplier.edit_ajax')->with('supplier', $supplier);
   }

   public function updateAjax(Request $request, string $id) {
    // 1. Perbaikan Unique Rule: Harus dipisahkan koma dan formatnya benar
    $rules = [
        'supplier_kode'   => 'required|string|max:100|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
        'supplier_nama'   => 'required|string|max:255',
        'supplier_alamat' => 'required|string|max:255',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status'   => false,
            'message'  => 'Validasi gagal.',
            'msgField' => $validator->errors()
        ]);
    }

    // 2. Perbaikan Nama Model (Pastikan PascalCase) dan pengecekan find()
    $supplier = SupplierModel::findOrFail($id); 
    
    if ($supplier) {
        $supplier->update($request->all());
        return response()->json([
            'status'  => true,
            'message' => 'Data supplier berhasil diupdate' // 3. Perbaikan pesan (sebelumnya "barang")
        ]);
    }

    return response()->json([
        'status'  => false,
        'message' => 'Data tidak ditemukan'
    ]);
}
    
}
