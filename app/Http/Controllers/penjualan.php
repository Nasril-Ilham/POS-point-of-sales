<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualanmodel;
use App\Models\usermodel;
use Yajra\DataTables\Facades\DataTables;


class penjualan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrum = (object) [
            'title' => 'Penjualan',
            'list' => ['home', 'penjualan']
        ];

        $activemenu = 'penjualan';

        $page = (object) [
            'title' => 'Data penjualan',
        ];

        $penjualanCount = penjualanmodel::count('*');

        return view('penjualan.index',[
            'penjualanCount' => $penjualanCount,
            'breadcrum' => $breadcrum,
            'activemenu' => $activemenu,
            'page' => $page,
        ]);
    }

    public function list(Request $request)
    {
        try {
            $penjualan = penjualanmodel::select('penjualan_id', 'user_id', 'penjualan_kode', 'pembeli', 'penjualan_tanggal');

            // ini datatabel yang akan di ambil oleh index.blade.php untuk menampilkan data secara ajax
            return DataTables::of($penjualan)
                ->addIndexColumn()
                ->addColumn('aksi', function($penjualan){
                    $btn = '<button onclick="modelAction(\''.url('/penjualan/'.$penjualan->penjualan_id.'/show').'\')" class="btn btn-sm btn-primary">Detail</button> ';
                    $btn .= '<button onclick="modelAction(\''.url('/penjualan/'.$penjualan->penjualan_id.'/edit').'\')" class="btn btn-sm btn-info">Edit</button> ';
                    $btn .= '<button onclick="modelAction(\''.url('/penjualan/'.$penjualan->penjualan_id.'/confirmDelete').'\')" class="btn btn-sm btn-danger">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function createAjax()
    {
        $penjualan = penjualanmodel::all();
        $user = usermodel::all();
        return view('penjualan.create', compact('penjualan', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAjax(Request $request)
    {
        $request->validate([
            'penjualan_tanggal' => 'required|date',
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required|string|max:255',
            'penjualan_kode' => 'required|string|max:255|unique:t_penjualan,penjualan_kode',
        ]);

        try {
            $penjualan = penjualanmodel::create($request->all());
            return response()->json(['success' => true, 'message' => 'Penjualan berhasil disimpan', 'data' => $penjualan], 201);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showAjax(string $id)
    {
        $penjualan = penjualanmodel::findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editAjax(string $id)
    {
        $penjualan = penjualanmodel::findOrFail($id);
        $user = usermodel::all();
        return view('penjualan.edit', compact('penjualan', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAjax(Request $request, string $id)
    {
        $request->validate([
            'penjualan_tanggal' => 'required|date',
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required|string|max:255',
            'penjualan_kode' => 'required|string|max:255|unique:t_penjualan,penjualan_kode,'.$id.',penjualan_id',
        ]);

        try {
            $penjualan = penjualanmodel::findOrFail($id);
            $penjualan->update($request->all());
            return response()->json(['status' => true, 'message' => 'Penjualan berhasil diperbarui', 'data' => $penjualan], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function confirmDeleteAjax(string $id)
    {
        $penjualan = penjualanmodel::findorFail($id);
        if (!$penjualan) {
            return response()->json(['error' => 'Data penjualan tidak ditemukan.'], 404);
        }
        return view('penjualan.confirm', compact('penjualan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAjax(string $id)
    {
        try {
            $penjualan = penjualanmodel::findOrFail($id);
            $penjualan->delete();
            return response()->json(['success' => true, 'message' => 'Penjualan berhasil dihapus'], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
