# 24g_simgizi_menu

Sistem informasi berbasisi web untuk manajemen data menu makanan pada layanan gizi, dikembangkan secara khsusus sebagai proyek ujian UTS.

## Fitur Aplikasi
 **Sistem Autentikasi:**
*  **Sistem Autentikasi Terpusat:** Dilengkapi dengan fitur *Login*, *Register*, dan *Logout* terproteksi menggunakan PHP Session untuk menjaga keamanan data.
*  **Manajemen Menu Makanan (CRUD):** Kemudahan bagi pengelola untuk Menambah, Melihat, Mengubah (Edit), dan Menghapus data menu makanan harian.
*  **Manajemen Kandungan Gizi:** Fitur khusus untuk mendata rincian nutrisi secara presisi (Kalori, Protein, Lemak, Karbohidrat) untuk setiap menu yang disajikan.
*  **Antarmuka Modern (Glassmorphism UI):** Mengusung desain *Desktop-first* yang mewah dengan efek kaca tembus pandang (*blur*) dan *custom styling* yang menimpa desain kaku Bootstrap standar.
* 🇮🇩 **Terintegrasi Tema Nasional:** Menggunakan skema warna profesional (Navy Blue & Sky Blue) yang disesuaikan dengan identitas visual Badan Gizi Nasional (BGN).

## Teknologi yang Digunakan

* **Backend:** PHP (Native)
* **Database:** MySQL (phpMyAdmin)
* **Frontend:** HTML5, CSS3, Bootstrap 5
* **Arsitektur:** Terstruktur dengan pemisahan folder yang rapi (`config`, `view`, `menu`, `gizi`, `assets`).

## Cara Menjalankan Aplikasi Secara Lokal (Localhost)
Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di komputer Anda:

1. Pastikan Anda sudah menginstal **XAMPP**. Buka XAMPP Control Panel, lalu jalankan (Start) modul **Apache** dan **MySQL**.
2. Unduh proyek ini (Download ZIP) atau *clone* repositori melalui terminal:
   ```bash
   git clone [https://github.com/username-github-anda/24g_simgizi_menu.git](https://github.com/username-github-anda/24g_simgizi_menu.git).
3. Pindahkan (atau extract) folder proyek tersebut ke dalam direktori lokal server Anda: C:\xampp\htdocs\.
4. Buka browser dan akses phpMyAdmin melalui URL: http://localhost/phpmyadmin
5. Buat database baru dengan nama sim_gizi.
6. Buat struktur tabel secara manual (users, menu_makanan, kandungan_gizi) dan pastikan kolom ID menggunakan Primary Key dan Auto Increment. (Atau import file .sql jika tersedia).
7. Buka file 'config/koneksi.php' dan kredensial server lokal :
```
php

$host = "localhost";
$user = "root";
$password = "";
$database = "sim_gizi";

$koneksi = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
```
8. Buka tab baru di browser, lalu jalankan aplikasi dengan mengakses URL berikut:http://localhost/24g_simgizi_menu/view/dashboard.php
   
