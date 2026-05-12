<?php

namespace App\Http\Controllers;

use App\Models\levelmodel;
use Doctrine\Inflector\Rules\French\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class levelcontroller extends Controller
{
    public function index(){
        $breadcrum = (object) [
            'title' => 'Data level',
            'list' => ['home', 'level']
        ];

        $_page = (object) [
            'title' => 'Data level yang tersedia',
        ];

        $activemenu = 'level';

        return view('level.index', ['breadcrum' => $breadcrum, 'page' => $_page, 'activemenu' => $activemenu]);
    }

    public function list(Request $request)
    {
        $level = levelmodel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($level)
            ->addIndexColumn()
            ->addColumn('aksi', function($level){
            $btn = '<button onclick="modelAction(\''.url('/level/'.$level->level_id.'/show_ajax').'\')" class="btn btn-sm btn-primary">Detail</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/level/'.$level->level_id.'/edit_ajax').'\')" class="btn btn-sm btn-info">Edit</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/level/'.$level->level_id.'/confirmDeleteAjax').'\')" class="btn btn-sm btn-danger">Hapus</button>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create()
    {
        $breadcrum = (object) [
            'title' => 'Tambah level',
            'list' => ['home', 'level', 'tambah']
        ];
        $page = (object) [
            'title' => 'Form tambah level',
        ];
        $activemenu = 'level';
        return view('level.create', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:50'
        ]);

        levelmodel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Detail level',
            'list' => ['home', 'level', 'detail']
        ];
        $page = (object) [
            'title' => 'Detail level',
        ];
        $level = levelmodel::findOrFail($id);
        $activemenu = 'level';
        return view('level.show', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'level' => $level]);
    }

    public function edit(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Edit level',
            'list' => ['home', 'level', 'edit']
        ];
        $page = (object) [
            'title' => 'Form edit level',
        ];
        $level = levelmodel::findOrFail($id);
        $activemenu = 'level';
        return view('level.edit', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'level' => $level]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode,'.$id.',level_id',
            'level_nama' => 'required|string|max:50'
        ]);

        $level = levelmodel::findOrFail($id);
        $level->level_kode = $request->level_kode;
        $level->level_nama = $request->level_nama;
        $level->save();

        return redirect('/level')->with('success', 'Data level berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $level = levelmodel::findOrFail($id);
        try{
            levelmodel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        }catch(\Exception $e){
            return redirect('/level')->with('error', 'Data level tidak bisa dihapus karena memiliki data user');
        }
    }

    // ajax
    public function createAjax(){
        $level = levelmodel::select('level_id')->get();
        return view('level.create_ajax')->with('level', $level);
    }

    public function storeAjax(Request $request){
        if ($request->json() || $request->wantsJson()){
            $rules = [
                'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:50'
            ];

            $validator = validator::make($request->all(),$rules);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            levelmodel::create([
                'level_kode' => $request->level_kode,
                'level_nama' => $request->level_nama
                
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil ditambahkan'
            ]);
        }

        redirect('/');
    }

    public function showAjax(string $id)
    {
        $level = levelmodel::findOrFail($id);
        return view('level.show_ajax')->with('level', $level);
    }

    public function editAjax(string $id){

        $level = levelmodel::findOrFail($id);
        return View('level.edit_ajax')->with('level', $level);
    }

  public function updateAjax(Request $request, string $id)
{
    $rules = [
        'level_kode' => 'required|string|max:10',
        'level_nama' => 'required|string|max:50'
    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails()){
        return response()->json([
            'status' => false,
            'message' => 'Validasi gagal',
            'msgField' => $validator->errors()
        ]);
    }

    $level = levelmodel::findOrFail($id);

    $level->level_kode = $request->level_kode;
    $level->level_nama = $request->level_nama;

    $level->save();

    return response()->json([
        'status' => true,
        'message' => 'Data berhasil diupdate'
    ]);
}
     public function confirmDeleteAjax(string $id){
        $level = levelmodel::findOrFail($id);
        return view('level.confirm_ajax')->with('level', $level);
     }

     public function destroyAjax(string $id){
        if(request()->ajax() || request()->wantsJson()){
            try {
                $level = levelmodel::findOrFail($id);
                $level->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data user berhasil dihapus'
                ]);
            } catch(\Exception $e){
                return response()->json([
                    'status' => false,
                    'message' => 'Data user tidak bisa dihapus karena memiliki transaksi'
                ]);
            }
        }
        return redirect ('/');
     }
}



