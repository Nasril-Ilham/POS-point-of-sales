<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usermodel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = usermodel::all();

        if($user ->isEmpty()){
            return response()->json([
                'status' => 404,
                'message' => 'tidak ada data user'
            ]);
        }
        return response()->json(
            [
                'status' => 200,
                'message' => 'User list retrieved successfully',
                'data' => $user
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_nama' => 'required|string|min:3|unique:m_user,user_nama',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'level_id' => 'required|integer'
        ]);

        // Create the user
        $user = usermodel::create([
            'user_nama' => $validatedData['user_nama'],
            'nama' => $validatedData['nama'],
            'password' => Hash::make($validatedData['password']),
            'level_id'=> $validatedData['level_id'],
        ]);

        return response()->json(
            [
                'status' => 201,
                'message' => 'User created successfully',
                'data' => $user
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = usermodel::FindOrFail($id);

        return response()->json([
           'status' => 200,
           'message' => 'data ada',
           'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = usermodel::findOrFail($id);

        if(!$user){
            return response()->json([
                'status' => 404,
                'message'=> 'data tidak ada',
            ]);
        }

        $validate = $request->validate([
            'user_nama' => 'required|string|min:3',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'level_id' => 'required|integer'
        ]);

        // ini untuk membuat hash kalau gk ada ini maka langsung plain text
        $validate['password'] = Hash::make($validate['password']);

        $user->update($validate);

        return response()->json([
            'status' => 200,
            'message' => 'data sudah terupdate',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = usermodel::findOrFail($id);

        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'data sudah di hapus'
        ]);
    }
}
