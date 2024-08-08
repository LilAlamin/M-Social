<p align="center"><a href="https://m-social.my.id/" target="_blank"><img src="https://i.ibb.co.com/dgS0ZTy/Gambar-Whats-App-2024-08-03-pukul-15-03-48-73b7236c.jpg" width="400" alt="M-Social Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# M-Social

M-Social adalah platform web untuk pengaduan masyarakat yang memungkinkan pengguna menyampaikan keluhan, laporan, atau masalah yang mereka hadapi. Platform ini dilengkapi dengan fitur untuk melacak status pengaduan, serta mengunggah bukti pendukung dalam bentuk foto atau video.

## Fitur

- **Pendaftaran Akun:**
  - Pengguna dapat membuat akun sesuai keinginan mereka untuk mengakses fitur pengaduan dan melacak status pengaduan.

- **Pengaduan:**
  - Pengguna dapat mengajukan pengaduan yang dilengkapi dengan foto atau video sebagai bukti tambahan.
  - Memudahkan pihak terkait untuk memahami dan menindaklanjuti pengaduan.

- **Info Status Pengaduan:**
  - Pengguna dapat melacak status pengaduan mulai dari "Belum Ditanggapi," "Sedang Diproses," hingga "Sudah Diproses."
  - Memberikan transparansi dalam penanganan pengaduan.

## Instalasi

1. Clone repository ini:
    ```bash
    git clone https://github.com/username/M-Social.git
    ```

2. Masuk ke direktori proyek:
    ```bash
    cd M-Social
    ```

3. Install dependencies menggunakan Composer:
    ```bash
    composer install
    ```

4. Buat file `.env` dari template:
    ```bash
    cp .env.example .env
    ```

5. Generate key aplikasi Laravel:
    ```bash
    php artisan key:generate
    ```

6. Atur konfigurasi database di file `.env`, kemudian jalankan migrasi:
    ```bash
    php artisan migrate
    ```

7. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

8. Akses aplikasi di browser di alamat `http://localhost:8000`.

## Kontribusi

Kami sangat mengapresiasi kontribusi dari siapa pun. Jika Anda tertarik untuk berkontribusi, silakan fork repository ini dan buat pull request dengan perubahan yang Anda lakukan.

## Harapan dan Pengembangan

Kami berharap M-Social dapat digunakan tidak hanya oleh masyarakat umum, tetapi juga oleh berbagai instansi seperti sekolah, rumah sakit, atau bahkan di lingkungan terkecil seperti RT dan RW. Tujuannya adalah untuk menjadikan M-Social sebagai alat komunikasi yang efektif dalam menyampaikan dan menindaklanjuti keluhan atau masalah.

## Lisensi

Proyek ini dilisensikan di bawah lisensi [MIT](LICENSE).


Lil Alamin @ 2024 Copyright All Right Reserved
