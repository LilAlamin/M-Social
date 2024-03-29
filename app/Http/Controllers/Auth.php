<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    //
    public function login()
    {
        return view('auth.Login');
    }

    public function masuk(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = DB::table('users')
            ->where(function ($query) use ($req) {
                $query->where('username', '=', $req->username)->orWhere('email', '=', $req->username);
            })
            ->first(['id_user', 'user_type', 'password']);

        if ($data && Hash::check($req->password, $data->password)) {
            $req->session()->put('user_id', $data->id_user);
            $req->session()->put('user_type', $data->user_type);

            if ($data->user_type == 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($data->user_type == 'user') {
                return redirect('/user/dashboard');
            } else {
                return redirect('/')->with('gagal', 'Akun Anda Tidak Terdaftar');
            }
        } else {
            return redirect('/')->with('gagal', 'Akun Anda Tidak Terdaftar');
        }
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the form data
        // $request->validate([
        //     'username' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|min:8',
        //     'terms' => 'accepted',
        // ]);

        // Hash the password before saving to the database
        $daftar = new users();

        $daftar->username = $request->username;
        $daftar->email = $request->email;
        $daftar->password = Hash::make($request->password);
        $daftar->save();

        // Redirect to the dashboard or any other desired page
        return redirect('/')->with('success', 'Registration successful!');
    }

    public function logout(Request $req)
    {
        $req->session()->flush('user_id');
        return redirect('/');
    }
}
