<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use App\Models\users;
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
    
    // public function getApprovalStatus($id_pengaduan)
    // {
    //     $pengaduan = Pengaduan::findOrFail($id_pengaduan);
    //     $isApproved = $pengaduan->status; // Mengambil nilai enum langsung

    //     return response()->json(['IsApproved' => $isApproved->value]);
    // }
    
    public function approveAction(Request $request)
    {
        $validatedData = $request->validate([
            'approvalStatus' => 'required|in:1,2', // Assuming the approval status can only be 1 or 2
            'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan', // Validate that the id_pengajuan exists in the Pengajuan table
        ]);

        $approvalStatus = $validatedData['approvalStatus'];
        $idPengaduan = $validatedData['id_pengaduan'];

        // Update the Pengajuan record based on the approval status
        $pengaduan = pengaduan::find($idPengaduan);
        if ($pengaduan) {
            $pengaduan->IsApproved = $approvalStatus;
            $pengaduan->save();
            
            $adminUser = users::find($request->session()->get('user_id'));

            // Add log entry
            // $logMessage = ($approvalStatus == 1) ? 'Pengajuan disetujui' : 'Pengajuan ditolak';
            // $logMessage .= ' oleh ' . $adminUser->username;
    
            // Log::create([
            //     'id_pengajuan' => $idPengajuan,
            //     'isi_log' => $logMessage,
            // ]);
            return redirect()->back()->with('message', 'Status Pengaduan Berhasil Diperbaharui');
        }

        return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
    }
}
