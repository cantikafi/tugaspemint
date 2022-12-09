<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function createProdi(Request $request) {
        $prodi = Prodi::create([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Prodi berhasil ditambahkan',
            'prodi' => $prodi
        ]);
    }
    public function oneProdi(Request $request) {
        $program_studi = Prodi::find($request->id);
        return response()->json([
            'success' => true,
            'message' => 'Menampilkan prodi',
            'program_studi' => $program_studi
        ]);
    }

    public function getProdi()
    {
        $program_studi = Prodi::all();

        return response()->json([
            'success' => true,
            'message' => 'Semua prodi ditampilkan',
            'prodi' => $program_studi
        ]);
    }
}