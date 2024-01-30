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
                <th>Username</th>
                <th>Judul Pengaduan</th>
                <th>Lokasi Kejadian</th>
                <th>Deskripsi Pengaduan</th>
                <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->number }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->judul_pengaduan }}</td>
                    <td>{{ $item->lokasi_pengaduan }}</td>
                    <td>{{ $item->deskripsi_pengaduan }}</td>
                    <!-- Tambahkan kolom-kolom lainnya sesuai kebutuhan -->
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
