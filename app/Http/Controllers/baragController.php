<?php

namespace App\Http\Controllers;

use App\Models\barangmodel;
use App\Models\categorymodel;
use App\Models\PenjualanDetailmodel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
        $barang = barangmodel::with('kategori')->select('*');

        if($request->barang_id){
            $barang->where('barang_id', $request->barang_id);
        }

        // ini datatabel yang akan di ambil oleh index.blade.php untuk menampilkan data secara ajax
        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function($barang){
            $btn = '<button onclick="modelAction(\''.url('/barang/'.$barang->barang_id.'/show_ajax').'\')" class="btn btn-sm btn-primary">Detail</button> ';

            if (Auth::check() && Auth::user()->getRole() == 'LVL001') {

            $btn .= '<button onclick="modelAction(\''.url('/barang/'.$barang->barang_id.'/edit_ajax').'\')" class="btn btn-sm btn-info">Edit</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/barang/'.$barang->barang_id.'/confirmDeleteAjax').'\')" class="btn btn-sm btn-danger">Hapus</button>';

            };
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
 
public function import(){
    return view('barang.import');
}

public function import_ajax(Request $request)
{
    if($request->ajax() || $request->wantsJson()){
        $rules = [
            // Validasi file harus xlsx, max 1MB
            'file_barang' => ['required', 'mimes:xlsx', 'max:1024']
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ]);
        }

        $file = $request->file('file_barang'); 

        try {
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true); 

            $insert = [];
            if(count($data) > 1){ 
                foreach ($data as $baris => $value) {
                    if($baris > 1){ 
                        // Tambahkan pengecekan jika kolom kosong agar tidak error database
                        if(!empty($value['A']) && !empty($value['B'])){
                            $insert[] = [
                                'kategori_id' => $value['A'],
                                'barang_kode' => $value['B'],
                                'barang_nama' => $value['C'],
                                'harga_beli'   => $value['D'],
                                'harga_jual'   => $value['E'],
                                'created_at'  => now(),
                            ];
                        }
                    }
                }

                if(count($insert) > 0){
                    // Menggunakan insertOrIgnore agar data duplikat tidak menyebabkan error
                    BarangModel::insertOrIgnore($insert);

                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil diimport'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Tidak ada data valid yang dapat diimport'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'File Excel kosong'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat membaca file: ' . $e->getMessage()
            ]);
        }
    }
    return redirect('/');
}

public function exportExcel(){
    $barang = barangmodel::select('kategori_id', 'barang_kode', 'barang_nama', 'harga_jual', 'harga_beli')
    ->orderby('kategori_id')
    ->with('kategori')
    ->get();

    // 5. Kemudian kita load library Spreadsheet dan kita tentukan header data pada baris pertama di excel
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif

$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Kode Barang');
$sheet->setCellValue('C1', 'Nama Barang');
$sheet->setCellValue('D1', 'Harga Beli');
$sheet->setCellValue('E1', 'Harga Jual');
$sheet->setCellValue('F1', 'Kategori');

$sheet->getStyle('A1:F1')->getFont()->setBold(true); // bold header

// 6. Selanjutnya, kita looping data yang telah kita dapatkan dari database, kemudian kita masukkan ke dalam cell excel
$no = 1; // nomor data dimulai dari 1
$baris = 2; // baris data dimulai dari baris ke 2
foreach ($barang as $key => $value) {
    $sheet->setCellValue('A' . $baris, $no);
    $sheet->setCellValue('B' . $baris, $value->barang_kode);
    $sheet->setCellValue('C' . $baris, $value->barang_nama);
    $sheet->setCellValue('D' . $baris, $value->harga_beli);
    $sheet->setCellValue('E' . $baris, $value->harga_jual);
    $sheet->setCellValue('F' . $baris, $value->kategori->kategori_nama); // ambil nama kategori
    $baris++;
    $no++;
}

// 7. Kita set lebar tiap kolom di excel untuk menyesuaikan dengan panjang karakter pada masing-masing kolom
foreach (range('A', 'F') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
}

// 8. Bagian akhir proses export excel adalah kita set nama sheet, dan proses untuk dapat di download oleh pengguna
$sheet->setTitle('Data Barang'); // set title sheet

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$filename = 'Data Barang ' . date('Y-m-d H:i:s') . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$writer->save('php://output');
exit;
}
// end function export_excel


public function exportPdf(){
    $barang = barangmodel::select('kategori_id','barang_kode','barang_nama','harga_beli','harga_jual')
    ->orderBY('kategori_id')
    ->orderBY('barang_kode')
    ->with('kategori')
    ->get();

    $pdf = pdf::loadView('barang.export_pdf', ['barang' => $barang]);
    $pdf->setPaper('a4','potrait');
    $pdf->setOption('isRemoteEnable',true);
    $pdf->render();

    return $pdf->stream('Data barang'.date('Y-m-d H-i-s').'.pdf');
}

}
