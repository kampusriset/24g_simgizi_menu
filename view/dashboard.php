<?php
session_start();
require_once __DIR__ ."/../config/koneksi.php";
if (!isset($_SESSION['username'])) {
    header("Location: ../view/login.php");
    exit;
}

include '../config/koneksi.php';

// Total Menu
$totalMenu = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM menu_makanan")
);

// Total Gizi
$totalGizi = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM kandungan_gizi")
);

// Data Menu Terbaru
$menuQuery = mysqli_query(
    $koneksi,
    "SELECT * FROM menu_makanan
    ORDER BY id_menu DESC
    LIMIT 5"
);

// Data Gizi Terbaru
$giziQuery = mysqli_query(
    $koneksi,
    "SELECT kg.*, mm.nama_menu
    FROM kandungan_gizi kg
    LEFT JOIN menu_makanan mm
    ON kg.id_menu = mm.id_menu
    ORDER BY kg.id_gizi DESC
    LIMIT 5"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard SIM GIZI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/style.css" rel="stylesheet">

<style>
.dashboard-card{
    border:none;
    border-radius:15px;
    transition:.3s;
}

.dashboard-card:hover{
    transform:translateY(-5px);
}

.icon-circle{
    width:80px;
    height:80px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    font-size:35px;
    color:white;
}

.icon-menu{
    background:#198754;
}

.icon-gizi{
    background:#0d6efd;
}

.welcome-card{
    background:linear-gradient(
        135deg,
        #198754,
        #20c997
    );
    color:white;
    border-radius:20px;
}

.stat-number{
    font-size:35px;
    font-weight:bold;
    color:#198754;
}
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">

    <div class="container">

        <a class="navbar-brand fw-bold">
            SIM GIZI
        </a>

        <div class="ms-auto">

            <span class="text-white me-3">
                <?= $_SESSION['username']; ?>
            </span>

            <a href="./logout.php"
               class="btn btn-light btn-sm">
                Logout
            </a>

        </div>

    </div>

</nav>

<div class="container mt-4">

    <!-- Welcome -->
    <div class="card welcome-card shadow mb-4">

        <div class="card-body p-4">

            <h3>Dashboard SIM GIZI</h3>

            <p class="mb-0">
                Sistem Informasi Menu Bergizi Sekolah
            </p>

        </div>

    </div>

    <!-- Statistik -->
    <div class="row mb-4">

        <div class="col-md-6">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Total Menu Makanan</h5>

                    <div class="stat-number">
                        <?= $totalMenu ?>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Total Data Gizi</h5>

                    <div class="stat-number text-primary">
                        <?= $totalGizi ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Shortcut -->
    <div class="row mb-4">

        <div class="col-md-6">

            <div class="card dashboard-card shadow">

                <div class="card-body text-center p-4">

                    <div class="icon-circle icon-menu mb-3">
                        🍱
                    </div>

                    <h4>Menu Makanan</h4>

                    <p class="text-muted">
                        Kelola data menu makanan bergizi.
                    </p>

                    <a href="../menu/tabel.php"
                       class="btn btn-primary">

                        Buka Modul

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card dashboard-card shadow">

                <div class="card-body text-center p-4">

                    <div class="icon-circle icon-gizi mb-3">
                        🥗
                    </div>

                    <h4>Kandungan Gizi</h4>

                    <p class="text-muted">
                        Kelola data kandungan gizi makanan.
                    </p>

                    <a href="../gizi/tabel.php"
                       class="btn btn-primary">

                        Buka Modul

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Tabel Menu -->
    <div class="card shadow mb-4">

        <div class="card-header">
            Data Menu Makanan Terbaru
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Nama Menu</th>
                        <th>Jenis</th>
                        <th>Tanggal Menu</th>
                    </tr>

                </thead>

                <tbody>

                <?php if(mysqli_num_rows($menuQuery) > 0): ?>

                    <?php while($menu = mysqli_fetch_assoc($menuQuery)): ?>

                    <tr>

                        <td><?= $menu['id_menu']; ?></td>

                        <td><?= $menu['nama_menu']; ?></td>

                        <td><?= $menu['jenis']; ?></td>

                        <td><?= $menu['tanggal_menu']; ?></td>

                    </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="4" class="text-center">
                            Belum ada data menu makanan
                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- Tabel Gizi -->
    <div class="card shadow">

        <div class="card-header">
            Data Kandungan Gizi Terbaru
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>ID Gizi</th>
                        <th>Menu</th>
                        <th>Kalori</th>
                        <th>Protein</th>
                        <th>Lemak</th>
                        <th>Karbohidrat</th>
                    </tr>

                </thead>

                <tbody>

                <?php if(mysqli_num_rows($giziQuery) > 0): ?>

                    <?php while($gizi = mysqli_fetch_assoc($giziQuery)): ?>

                    <tr>

                        <td><?= $gizi['id_gizi']; ?></td>

                        <td><?= $gizi['nama_menu']; ?></td>

                        <td><?= $gizi['kalori']; ?> kkal</td>

                        <td><?= $gizi['protein']; ?> gr</td>

                        <td><?= $gizi['lemak']; ?> gr</td>

                        <td><?= $gizi['karbohidrat']; ?> gr</td>

                    </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6" class="text-center">
                            Belum ada data kandungan gizi
                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>