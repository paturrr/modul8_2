<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar semua Mahasiswa (INDEX).
     */
    public function index()
    {
        return view('mahasiswa.index');
    }

    /**
     * Mengambil data Mahasiswa untuk kebutuhan AJAX (JSON).
     */
    public function getData()
    {
        $mahasiswas = Mahasiswa::orderBy('id', 'desc')->get();
        return response()->json(['data' => $mahasiswas]);
    }

    /**
     * Menyimpan data Mahasiswa baru ke DB (STORE).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas|max:15',
            'prodi' => 'required|string|max:100',
        ]);
        
        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'message' => 'Data berhasil disimpan', 
            'data' => $mahasiswa
        ], 201);
    }

    /**
     * Mengambil Mahasiswa tertentu berdasarkan ID untuk form edit (EDIT).
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($mahasiswa);
    }

    /**
     * Memperbarui data Mahasiswa tertentu di DB (UPDATE).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim,'.$id.'|max:15', 
            'prodi' => 'required|string|max:100',
        ]);
        
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        
        $mahasiswa->update($request->all());

        return response()->json([
            'message' => 'Data berhasil diperbarui',
            'data' => $mahasiswa
        ]);
    }

    /**
     * Menghapus Mahasiswa tertentu dari DB (DESTROY).
     */
    public function destroy($id)
    {
        $deleted = Mahasiswa::destroy($id);

        if (!$deleted) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Data berhasil dihapus']); 
    }
}