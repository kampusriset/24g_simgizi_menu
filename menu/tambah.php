<?php
include '../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama_menu = $_POST['nama_menu'];
    $jenis = $_POST['jenis'];
    $tanggal_menu = $_POST['tanggal_menu'];

    mysqli_query($koneksi, "
        INSERT INTO menu_makanan
        (nama_menu, jenis, tanggal_menu)
        VALUES
        ('$nama_menu', '$jenis', '$tanggal_menu')
    ");

    header("Location: tabel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Makanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header">
            <h3>Tambah Menu Makanan</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">
                        Nama Menu
                    </label>

                    <input
                        type="text"
                        name="nama_menu"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Jenis
                    </label>

                    <select
                        name="jenis"
                        class="form-select"
                        required>

                        <option value="">
                            -- Pilih Jenis --
                        </option>

                        <option value="Sarapan">
                            Sarapan
                        </option>

                        <option value="Siang">
                            Siang
                        </option>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Tanggal Menu
                    </label>

                    <input
                        type="date"
                        name="tanggal_menu"
                        class="form-control"
                        required>
                </div>

                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-primary">

                    Simpan
                </button>

                <a href="index.php"
                   class="btn btn-secondary">

                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>