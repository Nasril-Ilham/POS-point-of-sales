<?php

namespace App\Http\Controllers;

use App\Models\levelmodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

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
                $btn  = '<a href="'.url('/level/'.$level->level_id).'" class="btn btn-sm btn-info">Detail</a> ';
                $btn .= '<a href="'.url('/level/'.$level->level_id.'/edit').'" class="btn btn-sm btn-primary">Edit</a> ';
                $btn .= '<form action="'.url('/level/'.$level->level_id).'" method="POST" style="display:inline-block;">
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
}
