<?php

namespace App\Http\Controllers;

use App\Models\categorymodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\Clock\now;

class kategoricontroller extends Controller
{
    public function index(){
        $breadcrum = (object) [
            'title' => 'Data kategori',
            'list' => ['home', 'kategori']
        ];

        $_page = (object) [
            'title' => 'Data kategori yang tersedia',
        ];

        $activemenu = 'kategori';

        return view('category.index', ['breadcrum' => $breadcrum, 'page' => $_page, 'activemenu' => $activemenu]);
    }

    public function list(Request $request)
    {
        $kategori = categorymodel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function($kategori){
            $btn = '<button onclick="modelAction(\''.url('/kategori/'.$kategori->kategori_id.'/show_ajax').'\')" class="btn btn-sm btn-primary">Detail</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/kategori/'.$kategori->kategori_id.'/edit_ajax').'\')" class="btn btn-sm btn-info">Edit</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/kategori/'.$kategori->kategori_id.'/confirmDeleteAjax').'\')" class="btn btn-sm btn-danger">Hapus</button>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create()
    {
        $breadcrum = (object) [
            'title' => 'Tambah kategori',
            'list' => ['home', 'kategori', 'tambah']
        ];
        $page = (object) [
            'title' => 'Form tambah kategori',
        ];
        $activemenu = 'kategori';
        return view('category.create', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:100|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:1000'
        ]);

        categorymodel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Detail kategori',
            'list' => ['home', 'kategori', 'detail']
        ];
        $page = (object) [
            'title' => 'Detail kategori',
        ];
        $kategori = categorymodel::findOrFail($id);
        $activemenu = 'kategori';
        return view('category.show', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'kategori' => $kategori]);
    }

    public function edit(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Edit kategori',
            'list' => ['home', 'kategori', 'edit']
        ];
        $page = (object) [
            'title' => 'Form edit kategori',
        ];
        $kategori = categorymodel::findOrFail($id);
        $activemenu = 'kategori';
        return view('category.edit', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'kategori' => $kategori]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:100|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
            'kategori_nama' => 'required|string|max:1000'
        ]);

        $kategori = categorymodel::findOrFail($id);
        $kategori->kategori_kode = $request->kategori_kode;
        $kategori->kategori_nama = $request->kategori_nama;
        $kategori->save();

        return redirect('/kategori')->with('success', 'Data kategori berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $kategori = categorymodel::findOrFail($id);
        try{
            categorymodel::destroy($id);
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        }catch(\Exception $e){
            return redirect('/kategori')->with('error', 'Data kategori tidak bisa dihapus karena memiliki data barang');
        }
    }

    // ajax
    public function createAjax(){
        $kategori = categorymodel::select('kategori_id', 'kategori_nama')->get();
        return view('category.create_ajax')->with('kategori', $kategori);
    }

    public function storeAjax(Request $request)
    {
        if ($request->ajax()  || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:100|unique:m_kategori,kategori_kode',
                'kategori_nama' => 'required|string|max:1000'
            ];

            $validator = Validator::make($request->all(), $rules);

            $kategori = categorymodel::create([
                'kategori_kode' => $request->kategori_kode,
                'kategori_nama' => $request->kategori_nama
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil ditambahkan'
            ]);

        }

        return redirect('/');
    }

    public function showAjax(string $id)
    {

    $kategori = categorymodel::findOrFail($id);
    return view('category.show_ajax')->with('kategori', $kategori);

    }

   public function editAjax(string $id){
    $kategori = categorymodel::findOrFail($id);
    return view('category.edit_ajax')->with('kategori', $kategori);
   }

    public function updateAjax(Request $request, string $id)
{
    if($request->ajax() || $request->wantsJson()){

        $rules = [
             'kategori_kode' => 'required|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|string|max:1000'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'msgField' => $validator->errors()
            ]);
        }

        // simpan ke database
        $kategori = categorymodel::findOrFail($id);

        $kategori->kategori_kode = $request->kategori_kode;
        $kategori->kategori_nama= $request->kategori_nama;

        $kategori->save();

        // response AJAX
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diupdate'
        ]);
    }
}

public function confirmDeleteAjax(string $id){
        $kategori = categorymodel::findOrFail($id);
        return view('category.confirm_ajax')->with('kategori', $kategori);
     }

     public function destroyAjax(string $id) {
    if (request()->ajax() || request()->wantsJson()) {
        try {
            $kategori = categorymodel::findOrFail($id);
            $kategori->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak bisa dihapus karena masih terkait dengan data barang'
            ]);
        }
    }
    return redirect('/');
}
}