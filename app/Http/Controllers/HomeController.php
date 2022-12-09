<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function home(Request $request){
        $mahasiswa = $request->mahasiswa;
        $mahasiswa->matakuliahs()->attach($request->matkulid);
        return response()->json([
            'status' => 'Success',
            'message' => "Selamat datang $mahasiswa->nama",
        ], 200);
    }
}
