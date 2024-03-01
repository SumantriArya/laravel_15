<?php

namespace App\Http\Controllers;
use App\Models\Jenis_produk;
use Illuminate\Http\Request;

class jenis_produkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNKAN UNTUK MENGAMBIL SEMUA DATA
        $jenis_produk = jenis_produk::all();
        if (isset($jenis_produk)) {
            $sukses = [
                'success' => true,
                'message' => 'Data Berhasil',
                'data' => $jenis_produk
            ];
            return response()->json($sukses, 200);
        } else {
            $gagal = [
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => null
            ];
            return response()->json($gagal, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            "id" => $request->id,
            "nama_jenis" => $request->nama_jenis
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                "message" => "Data Jurusan Tidak Valid",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
        } else {
            $jrs = Jenis_produk::create($request->all());
            $success = [
                "message" => "Data Jurusan Berhasil Ditambahkan",
                "data" => $jrs
            ];
            return response()->json($success, 201);
        }
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "nama_jenis" => "required"
        ]);

        if ($validator->fails()) {
            $fails = [
                "message" => "Data Jurusan Tidak Valid",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
        }

        $jenis_produk = Jenis_produk::find($id);
        if (!isset($jenis_produk)) {
            $fails = [
                "message" => "Data Jurusan Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
        }

        $jenis_produk->update($request->all());
        $success = [
            "message" => "Data Jurusan Berhasil Diubah",
            "data" => $jenis_produk
        ];
        return response()->json($success, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA BERDASARKAN ID
        $jenis_produk = Jenis_produk::find($id);
        if (isset($jenis_produk)) {
            $sukses = [
                'success' => true,
                'message' => 'Data Berhasil',
                'data' => $jenis_produk
            ];
            return response()->json($sukses, 200);
        } else {
            $gagal = [
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => null
            ];
            return response()->json($gagal, 404);
        }
    }
}
