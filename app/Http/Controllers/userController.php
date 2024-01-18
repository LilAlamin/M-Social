<?php

namespace App\Http\Controllers;

use App\Models\file;
use App\Models\pengaduan;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    //
    public function index(Request $req)
    {
        if (!$req->session()->has('user_id') || $req->session()->get('user_type') !== 'user') {
            // Redirect jika tidak ada sesi user_id atau user_type bukan admin
            return redirect('404')->with('error', 'Anda tidak diizinkan untuk mengakses halaman ini.');
        }
        $user_id = $req->session()->get('user_id');

        $data = pengaduan::where('pengaduan.IsDelete', 0)
            ->where('pengaduan.id_user', $user_id)
            ->get(); // Tambahkan kondisi where untuk user_id

        return view('user.index', compact('data'));
    }

    public function formPengajuan()
    {
        return view('user.pengaduan');
    }

    public function store(Request $request)
    {
        $user = users::find($request->session()->get('user_id'));

        //Menyimpan data pengajuan
        $pengaduan = pengaduan::create([
            'judul_pengaduan' => $request->judul,
            'lokasi_pengaduan' => $request->lokasi,
            'deskripsi_pengaduan' => $request->deskripsi,
            'id_user' => $request->session()->get('user_id'),
        ]);

        // Log::create([
        //     'id_pengajuan' => $pengajuan->id_pengajuan,
        //     'isi_log' => 'Pengajuan dibuat oleh ' . $user->username,
        // ]);

        $files = $request->file('file');

        // Pastikan $files adalah array sebelum menggunakan fungsi count
        if (is_array($files)) {
            // Iterate through the array
            for ($i = 0; $i < count($files); $i++) {
                $dokumen = new file();
                $dokumen->id_pengaduan = $pengaduan->id_pengaduan;

                if (isset($files[$i])) {
                    $file = $files[$i];
                    $fileName = time() . '_' . $i . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/Foto', $fileName);
                    $dokumen->nama_file = $fileName;
                } else {
                    // Handle no file uploaded. You could provide a default file or cancel the operation
                    $dokumen->nama_file = 'default.txt'; // Misalnya, berikan nilai default
                }

                $dokumen->save();
            }

            return redirect('/dashboard')->with('pesan', 'Data Berhasil Ditambahkan');
        }
    }
    public function destroy($id)
    {
        // Find the pengajuan
        $pengaduan = pengaduan::find($id);
    
        // If we didn't find a valid pengajuan, then redirect (or error, etc.)
        if (!$pengaduan) {
            return redirect()
                ->back()
                ->with('error', 'Invalid pengajuan ID');
        }
    
        // We found the pengajuan, so 'delete' it and then redirect (or whatever you want to do)
        $pengaduan->IsDelete = 1;
        $pengaduan->save();
    
        // Get the admin user who is performing the update
        // $user = admin::find(session('user_id'));
    
        // Create a log entry
        // Log::create([
        //     'id_pengajuan' => $pengajuan->id_pengajuan,
        //     'isi_log' => 'Pengajuan Telah Dihapus oleh ' . $user->username,
        // ]);
    
        // Redirect (or whatever you'd like to do after 'deleting' the pengajuan)
        return redirect()
            ->back()
            ->with('hapus', 'Pengajuan deleted successfully');
    }
}
