<?php
include '../config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM menu_makanan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Menu Makanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Menu Makanan</h2>

        <a href="tambah.php" class="btn btn-primary">
            + Tambah Menu
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Menu</th>
                <th>Jenis</th>
                <th>Tanggal Menu</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>

        <?php while($data = mysqli_fetch_assoc($query)) : ?>

            <tr>
                <td><?= $data['id_menu']; ?></td>
                <td><?= $data['nama_menu']; ?></td>
                <td><?= $data['jenis']; ?></td>
                <td><?= $data['tanggal_menu']; ?></td>

                <td>
                    <a href="edit.php?id=<?= $data['id_menu']; ?>"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="hapus.php?id=<?= $data['id_menu']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus data?')">
                        Hapus
                    </a>
                </td>
            </tr>

        <?php endwhile; ?>

        </tbody>
    </table>

</div>

</body>
</html>