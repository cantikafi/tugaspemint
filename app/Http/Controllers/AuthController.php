<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //

        $this->request = $request;
    }

    protected function jwt(Mahasiswa $mahasiswa){
        $payload = [
            'iss' => 'lumen-jwt',
            'sub' => $mahasiswa->nim,
            'iat' => time(),
            'exp' => time() + 60
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public function register(Request $request){
        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'password' => Hash::make($request->password),
            'prodiId' => $request->prodiId
        ]);
        $program_studi = Prodi::find($mahasiswa->prodiId);
        return response()->json([
            'status' => 'Register berhasil',
            'message' => 'Mahasiswa berhasil ditambahkan',
            'mahasiswa' => [
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'angkatan' => $mahasiswa->angkatan,
                'prodiId' => $program_studi->prodiId
            ]
        ]);
    }

    public function login(Request $request){
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
        if (!$mahasiswa){
            return response()->json([
                'status' => 'Login Gagal!',
                'message' => 'Mahasiswa belum terdaftar'
            ],400);
        }

        if(!Hash::check($request->password, $mahasiswa->password)){
            return response()->json([
                'status' => 'Login Gagal!',
                'message' => 'Password anda salah'
            ], 400);
        }

        $mahasiswa->token = $this->jwt($mahasiswa);
        $mahasiswa->save();

        return response()->json([
            'status' => 'Login Berhasil!',
            'message' => "Selamat datang $mahasiswa->nama ^^",
            'token' => $mahasiswa->token
        ], 200);
    }
}
