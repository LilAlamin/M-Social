<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(Request $req)
    {
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'admin') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
        // $user_id = $req->session()->get('user_id');

        $data = Pengaduan::where('pengaduan.IsDelete', 0)
        ->leftJoin('users', 'pengaduan.id_user', '=', 'users.id_user')
        ->select('pengaduan.*', 'users.username as username')
        ->get();
     // Tambahkan kondisi where untuk user_id

        return view('admin.index', compact('data'));
    }
    public function fetchJudul($id)
    {
        $judul = DB::table('pengaduan')
            ->select('judul_pengaduan')
            ->where('id_pengaduan', $id)
            ->first();

        // Assuming $judul is an object with 'judul_pengaduan' property
        return response()->json($judul);
    }
}
