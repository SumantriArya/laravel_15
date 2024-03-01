<?php

namespace App\Http\Controllers;
use App\Models\produk;
use Illuminate\Http\Request;

class produkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNAKAN UNTUK MENGAMBIL SEMUA DATA
        $produk = produk::all();
        if (isset($produk)) {
            $sukses = [
                'success' => true,
                'message' => 'Data Berhasil',
                'data' => $produk
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
            "nama" => $request->nama,
            "id_jenis" => $request->id_jenis
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                "message" => "Data Jurusan Tidak Valid",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
        } else {
            $jrs = produk::create($request->all());
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
        //DiGUNAKAN UNTUK MENGAMBIL DATA BERDASARKAN ID
        $produk = produk::find($id);
        if (isset($produk)) {
            $sukses = [
                'success' => true,
                'message' => 'Data Berhasil',
                'data' => $produk
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "nama" => "required",
            "id_jenis" => "required"
        ]);

        if ($validator->fails()) {
            $fails = [
                "message" => "Data Jurusan Tidak Valid",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
        }

        $produk = produk::find($id);
        if (!isset($produk)) {
            $fails = [
                "message" => "Data Jurusan Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA BERDASARKAN ID
        $produk = produk::find($id);
        if (isset($produk)) {
            $sukses = [
                'success' => true,
                'message' => 'Data Berhasil',
                'data' => $produk
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
