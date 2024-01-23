@extends('layouts.user')  {{-- Assuming you have a master layout file called 'app.blade.php' --}}

@section('user')
    <div class="container">
        <h1>Detail Pengaduan</h1>

        <div>
            <h4>Judul Pengaduan: {{ $pengaduan->judul_pengaduan }}</h4>
            <p>Lokasi Pengaduan: {{ $pengaduan->lokasi_pengaduan }}</p>
            <p>Status Pengaduan: 
                @if ($pengaduan->IsApproved == 0)
                    <span class="bg-info text-white p-2 rounded">Menunggu</span>
                @elseif ($pengaduan->IsApproved == 1)
                    <span class="bg-success text-white p-2 rounded">Pengaduan Berhasil Ditindak Lanjuti</span>
                @endif
            </p>
            <p>Deskripsi Pengaduan: {{ $pengaduan->deskripsi_pengaduan }}</p>
            <p>Username: {{ $user->username }}</p>
        </div>

        {{-- Add any other details you want to display --}}
    </div>
@endsection
