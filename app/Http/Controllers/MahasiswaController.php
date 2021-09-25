<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Mahasiswa',
            'data' => $mahasiswa,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //buat validasi dulu
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
            'alamat' => 'required',
        ]);
        //respon eror validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //simpan ke database
        $simpan = Mahasiswa::create([
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat' => $request->alamat
        ]);

        //respon sukses 
        if ($simpan) {
            return response()->json([
                'success' => true,
                'message' => 'Data mahasiswa berhasil di simpan',
                'data' => $simpan,
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'gagal simpan',
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('nim', $id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Detail Data',
            'data' => $mahasiswa
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
            'alamat' => 'required',
        ]);
        //respon eror validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //simpan ke database
        $simpan = Mahasiswa::findOrFail($id);
        $simpan->update([
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat' => $request->alamat
        ]);

        //respon sukses 
        if ($simpan) {
            return response()->json([
                'success' => true,
                'message' => 'Data mahasiswa berhasil di update',
                'data' => $simpan,
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'gagal update',
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Mahasiswa::findOrFail($id);
        if ($hapus) {
            $hapus->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus',
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan',
        ], 404);
    }
}
