<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;


class MataKuliahController extends Controller
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

    public function createMataKuliah(Request $request){
        $mata_kuliah = Matakuliah::create([
            'nama'=>$request->nama,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil ditambahkan',
            'mataKuliah' => $mata_kuliah
        ]);

    }
    public function getMataKuliah(){
        $mata_kuliah = Matakuliah::all();
        return response()->json([
            'success' => true,
            'message' => 'Menampilkan semua prodi',
            'matakuliah' => $mata_kuliah
        ]);
    }
}
