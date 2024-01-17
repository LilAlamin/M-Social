<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    //
    public function index(Request $req){
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'admin') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
    
    
        return view('admin.index');
    }
}
