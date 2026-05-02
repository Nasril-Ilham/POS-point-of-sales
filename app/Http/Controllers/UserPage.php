<?php

namespace App\Http\Controllers;

use App\Models\usermodel;
use App\Models\levelmodel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\Message;
use Psy\Readline\Interactive\Input\Buffer;
use Yajra\DataTables\DataTables;

class UserPage extends Controller
{
 public function index()
 {
  $breadcrum = (object) [
    'title' => 'Data user',
    'list' => ['home', 'user']
];

$page = (object) [
    'title' => 'Data user yang tersedia',
];

$activemenu = 'user';
$levels = levelmodel::all();

  return view('user.index', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'levels' => $levels]);
    
 }

public function list(Request $request)
{
    $user = usermodel::select('user_id', 'user_nama', 'nama', 'level_id')
        ->with('level');

    // Jika ada filter level_id, tambahkan kondisi where
    if($request->level_id){
        $user->where('level_id', $request->level_id);
    }

    return DataTables::of($user)
        ->addIndexColumn()
        ->addColumn('aksi', function($user){
            // $btn  = '<a href="'.url('/user/'.$user->user_id).'" class="btn btn-sm btn-info">Detail</a> ';
            // $btn .= '<a href="'.url('/user/'.$user->user_id.'/edit').'" class="btn btn-sm btn-primary">Edit</a> ';
            // $btn .= '<form action="'.url('/user/'.$user->user_id).'" method="POST" style="display:inline-block;">
            //             ' . csrf_field() . ' ' . method_field('DELETE') . '
            //             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</button>
            //          </form>';
            $btn = '<button onclick="modelAction(\''.url('/user/'.$user->user_id.'/show_ajax').'\')" class="btn btn-sm btn-primary">Detail</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/user/'.$user->user_id.'/edit_ajax').'\')" class="btn btn-sm btn-info">Edit</button> ';
            $btn .= '<button onclick="modelAction(\''.url('/user/'.$user->user_id.'/confirmDeleteAjax').'\')" class="btn btn-sm btn-danger">Hapus</button>';

            return $btn;
        })
        ->rawColumns(['aksi'])
        ->toJson(); // 🔥 WAJIB
        // toJson() untuk mengubah data yang diambil dari database menjadi format JSON yang bisa di proses oleh DataTables
        // di sisi client untuk menampilkan data yang sudah di ambil dari database ke dalam tabel yang sudah di buat di view user.index
}

 public function create()
 {
  $breadcrum = (object) [
    'title' => 'Tambah user',
    'list' => ['home', 'user', 'tambah']
];
$page = (object) [
    'title' => 'Form tambah user',
];
$levels = levelmodel::all();
// levelmodel::all() untuk mengambil semua data level yang ada di database dan di kirim ke view untuk di tampilkan di form tambah user
$activemenu = 'user';
  return view('user.create', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'levels' => $levels]);
 }

 public function store(Request $request)
 {
    $request->validate([
        'user_nama' => 'required|string|min:3|unique:m_user,user_nama',
        'nama' => 'required|string|max:100',
        'password' => 'required|string|min:6',
        'level_id' => 'required|integer'
    ]);

    // validasi di atas untuk memastikan data yang di inputkan oleh user sesuai dengan aturan yang sudah di tentukan, seperti user_nama harus unik di tabel m_user, password minimal 6 karakter, dan lain sebagainya

    usermodel::create([
        'user_nama' => $request->user_nama,
        'nama' => $request->nama,
        'password' => Hash::make($request->password),
        'level_id' => $request->level_id
    ]);

    return redirect('/user')->with('success', 'Data user berhasil ditambahkan');
 }
 
 public function show(string $id)
 {
    $breadcrum = (object) [
        'title' => 'Detail user',
        'list' => ['home', 'user', 'detail']
    ];
    $page = (object) [
        'title' => 'Detail user',
    ];
    $user = usermodel::with('level')->findOrFail($id);
    $activemenu = 'user';
    return view('user.show', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'user' => $user]);
 }

    public function edit(string $id)
    {
        $breadcrum = (object) [
            'title' => 'Edit user',
            'list' => ['home', 'user', 'edit']
        ];
        $page = (object) [
            'title' => 'Form edit user',
        ];
        $user = usermodel::findOrFail($id);
        $levels = levelmodel::all();
        $activemenu = 'user';
        return view('user.edit', ['breadcrum' => $breadcrum, 'page' => $page, 'activemenu' => $activemenu, 'user' => $user, 'levels' => $levels]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_nama' => 'required|string|min:3|unique:m_user,user_nama,'.$id.',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|string|min:6',
            'level_id' => 'required|integer'
        ]);

        $user = usermodel::findOrFail($id);
        $user->user_nama = $request->user_nama;
        $user->nama = $request->nama;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->level_id = $request->level_id;
        $user->save();

        return redirect('/user')->with('success', 'Data user berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $check = usermodel::findOrFail($id);
        if(!$check ){
            return redirect('/user')->with('error', 'Data user tidak bisa dihapus karena memiliki transaksi');
        }
        try{
             usermodel::destroy($id);
                return redirect('/user')->with('success', 'Data user berhasil dihapus');
        }catch(\Exception $e){
            return redirect('/user')->with('error', 'Data user tidak bisa dihapus karena memiliki transaksi');
        }
    }

    public function createAjax()
    {
        $levels = levelmodel::select('level_id', 'level_nama')->get();
        return view('user.create_ajax')->with('levels', $levels);
    }

    public function storeAjax(Request $request)
    {
       if($request->ajax() || $request->wantsJson()){
           $rules = [
                'user_nama' => 'required|string|min:3|unique:m_user,user_nama',
                'nama' => 'required|string|max:100',
                'password' => 'required|string|min:6',
                'level_id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            usermodel::create([
                'user_nama' => $request->user_nama,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
                'level_id' => $request->level_id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil ditambahkan'
            ]);
        }
        return redirect ('/');
    }

    public function editAjax(string $id)
    {
        $user = usermodel::findOrFail($id);
        $levels = levelmodel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax')->with(['user' => $user, 'levels' => $levels]);
    }

    public function updateAjax(Request $request, string $id)
    {
        if($request->ajax() || $request->wantsJson()){
            $rules = [
                'user_nama' => 'required|string|min:3|unique:m_user,user_nama,'.$id.',user_id',
                'nama' => 'required|string|max:100',
                'password' => 'nullable|string|min:6',
                'level_id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $user = usermodel::findOrFail($id);
            $user->user_nama = $request->user_nama;
            $user->nama = $request->nama;
            $user->level_id = $request->level_id;
            if($request->password){
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil diupdate'
            ]);
        }
        return redirect ('/');
    }

    public function showAjax(string $id)
    {
        $user = usermodel::with('level')->findOrFail($id);
        return view('user.show_ajax')->with('user', $user);
    }

    public function confirmDeleteAjax(string $id)
    {
        $user = usermodel::findOrFail($id);
        return view('user.confirm_ajax_delete')->with('user', $user);
    }
   
    // karna memiliki relasi dengan tabel lain seperti stok, maka ketika user di hapus akan di cek terlebih dahulu apakah user tersebut memiliki transaksi atau tidak, jika memiliki transaksi maka data user tidak bisa di hapus dan akan menampilkan pesan error, namun jika tidak memiliki transaksi maka data user akan di hapus dan menampilkan pesan success
    // cara agar bisa cascade delete atau menghapus data user beserta data stok yang berelasi dengan user tersebut bisa menggunakan on delete cascade di database, namun cara ini tidak di sarankan karena bisa menyebabkan data yang tidak di inginkan ikut terhapus, seperti data stok yang seharusnya masih di butuhkan untuk laporan atau keperluan lainnya ikut terhapus ketika user di hapus, maka dari itu cara yang lebih aman adalah dengan melakukan pengecekan terlebih dahulu sebelum menghapus data user, jika memiliki transaksi maka data user tidak bisa
    // trs cara yang benar adalah dengan melakukan pengecekan terlebih dahulu sebelum menghapus data user, jika memiliki transaksi maka data user tidak bisa di hapus dan akan menampilkan pesan error, namun jika tidak memiliki transaksi maka data user akan di hapus dan menampilkan pesan success
    // tabel di bawah ini terhubung dengan level_id di tabel m_level, maka ketika data level di hapus akan di cek terlebih dahulu apakah data level tersebut memiliki relasi dengan data user atau tidak, jika memiliki relasi dengan data user maka data level tidak bisa di hapus dan akan menampilkan pesan error, namun jika tidak memiliki relasi dengan data user maka data level akan di hapus dan menampilkan pesan success

    public function destroyAjax(string $id)
    {
        if(request()->ajax() || request()->wantsJson()){
            try {
                $user = usermodel::find($id);
                $user->delete();
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

    // contoh cascade delete yang tidak di sarankan, karena bisa menyebabkan data yang tidak di inginkan ikut terhapus, seperti data stok yang seharusnya masih di butuhkan untuk laporan atau keperluan lainnya ikut terhapus ketika user di hapus, maka dari itu cara yang lebih aman adalah dengan melakukan pengecekan terlebih dahulu sebelum menghapus data user, jika memiliki transaksi maka data user tidak bisa dihapus
//     public function destroyAjax(string $id)
// {
//     if(request()->ajax() || request()->wantsJson()){
//         $user = usermodel::find($id);

//         if(!$user){
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Data user tidak ditemukan'
//             ]);
//         }

//         try {
//             // Dengan Cascade di Migration, transaksi akan otomatis hilang
//             $user->delete();
            
//             return response()->json([
//                 'status' => true,
//                 'message' => 'Data user dan transaksi terkait berhasil dihapus'
//             ]);
//         } catch(\Exception $e){
//             return response()->json([
//                 'status' => false,
//                 'message' => 'Gagal menghapus data: ' . $e->getMessage()
//             ]);
//         }
//     }
//     return redirect('/');
// }
}