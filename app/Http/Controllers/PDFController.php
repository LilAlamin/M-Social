<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Symfony\Component\Process\Process;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\file;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $data = Pengaduan::where('pengaduan.IsDelete', 0)
            ->leftJoin('users', 'pengaduan.id_user', '=', 'users.id_user')
            ->with('files') // Eager load the files relationship
            ->select('pengaduan.*', 'users.username as username')
            ->get();

        // Add a unique number to each item in $data
        $data = $data->map(function ($item, $index) {
            $item->number = $index + 1;
            return $item;
        });

        if ($request->has('download')) {
            $pdf = PDF::loadView('pdf.rekap', ['data' => $data])->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('rekap_pengaduan.pdf');
        }

        return view('pdf.rekap', ['data' => $data]);
    }
}

