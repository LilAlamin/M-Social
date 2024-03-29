<!DOCTYPE html>
<html>

<head>
    <title>Rekap Pengaduan</title>
</head>

<body>

    <h2>Rekap Pengaduan</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengadu</th>
                <th>Judul Pengaduan</th>
                <th>Lokasi Kejadian</th>
                <th>Deskripsi Pengaduan</th>
                <th>Lampiran</th>
                <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->number }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->judul_pengaduan }}</td>
                <td>{{ $item->lokasi_pengaduan }}</td>
                <td>{{ $item->deskripsi_pengaduan }}</td>
                <td>
                    <!-- Check if files relationship is not empty before looping -->
                    @if ($item->files->isNotEmpty())
                        @foreach ($item->files as $file)
                            <!-- Use $file->nama_file as needed -->
                            @php
                                $path = public_path('storage/Foto/' . $file->nama_file);
                                $file = file_get_contents($path);
                                $base64 = base64_encode($file);
                            @endphp
                            <img src="data:image/png;base64,{{ $base64 }}" width="200" style="margin-top: 20px;">
                            @endforeach
                    @endif
                </td>
                <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
            </tr>
        @endforeach


        </tbody>
    </table>

</body>

</html>
