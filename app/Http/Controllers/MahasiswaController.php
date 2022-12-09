<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
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
    public function createMahasiswa(Request $request) {
        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'password' => $request->password,
            'prodiId' => $request->prodiId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa telah terdaftar',
            'mahasiswa' => $mahasiswa
        ]);
    }
    public function getMahasiswa() {

        $mahasiswas = Mahasiswa::with('prodi')->get(['nim','nama','angkatan','prodiId']);

        return response()->json([
            'success' => true,
            'message' => 'Menampilkan nama mahasiswa',
            'mahasiswa' => $mahasiswas
        ]);
    }
    public function tambahMatKul($nim, $mkId){
        $mahasiswa = Mahasiswa::find($nim);
        $mahasiswa->matakuliah()->attach($mkId);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan mata kuliah'
        ]);
        
    }
    public function getByNim($nim){
        $mahasiswa = Mahasiswa::with('matakuliah', 'prodi')->find($nim);
        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa ditampilkan',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function hapusMatKul($nim, $mkId){
        $mahasiswa = Mahasiswa::find($nim);
        $mahasiswa->matakuliah()->detach($mkId);
        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil dihapus'
        ]);
    }
       
}