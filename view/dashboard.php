
<?php
require_once __DIR__ . '/../auth/auth.php';
require_once __DIR__ . '/../config/koneksi.php';

// Total Menu
$totalMenu = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM menu_makanan")
);

// Total Gizi
$totalGizi = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM kandungan_gizi")
);

// Data Dashboard (Join Menu + Gizi)
$dashboardQuery = mysqli_query(
    $koneksi,
    "SELECT
        mm.id_menu,
        mm.nama_menu,
        mm.jenis,
        mm.tanggal_menu,
        kg.kalori,
        kg.protein,
        kg.lemak,
        kg.karbohidrat
    FROM menu_makanan mm
    LEFT JOIN kandungan_gizi kg
        ON mm.id_menu = kg.id_menu
    ORDER BY mm.id_menu DESC
    LIMIT 10"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard SIM GIZI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="../assets/style.css" rel="stylesheet">

<style>
body{
    background:#f8faf8;
}

.welcome-card{
    background:linear-gradient(135deg,#198754,#20c997);
    color:white;
    border:none;
    border-radius:20px;
}

.stat-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-4px);
}

.gradient-green{
    background:linear-gradient(135deg,#198754,#20c997);
    color:white;
}

.gradient-blue{
    background:linear-gradient(135deg,#0d6efd,#4dabf7);
    color:white;
}

.dashboard-card{
    border:none;
    border-radius:20px;
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
    font-size:32px;
    color:white;
}

.icon-menu{
    background:#198754;
}

.icon-gizi{
    background:#0d6efd;
}

.glass-card{
    background:white;
    border:none;
    border-radius:20px;
}

.badge-menu{
    background:#198754;
    color:white;
    padding:8px 14px;
    border-radius:50px;
}

.table thead{
    background:#198754;
    color:white;
}

.table tbody tr:hover{
    background:#f5fff8;
}

.navbar{
    border-radius:0 0 15px 15px;
}
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">

    <div class="container">

        <a class="navbar-brand fw-bold">
            MENU BERGIZI SEKOLAH
        </a>

        <div class="ms-auto">

            <span class="text-white me-3">
                <i class="bi bi-person-circle"></i>
                <?= $_SESSION['username']; ?>
            </span>

            <a href="logout.php" class="btn btn-light btn-sm">
                Logout
            </a>

        </div>

    </div>

</nav>

<div class="container mt-4">

    <!-- Welcome -->
    <div class="card welcome-card shadow mb-4">

        <div class="card-body p-4">

            <h2 class="fw-bold">
                Selamat Datang, <?= $_SESSION['username']; ?>
            </h2>

            <p class="mb-0">
                Sistem Informasi Menu Bergizi Sekolah
            </p>

        </div>

    </div>

    <!-- Statistik -->
    <div class="row mb-4">

        <div class="col-md-6 mb-3">

            <div class="card stat-card gradient-green shadow">

                <div class="card-body">

                    <h6>Total Menu Makanan</h6>

                    <h1 class="fw-bold">
                        <?= $totalMenu ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <div class="card stat-card gradient-blue shadow">

                <div class="card-body">

                    <h6>Total Data Gizi</h6>

                    <h1 class="fw-bold">
                        <?= $totalGizi ?>
                    </h1>

                </div>

            </div>

        </div>

    </div>

    <!-- Shortcut -->
    <div class="row mb-4">

        <div class="col-md-6 mb-3">

            <div class="card dashboard-card shadow">

                <div class="card-body text-center p-4">

                    <div class="icon-circle icon-menu mb-3">
                        <i class="bi bi-egg-fried"></i>
                    </div>

                    <h4>Menu Makanan</h4>

                    <p class="text-muted">
                        Kelola data menu makanan bergizi.
                    </p>

                    <a href="../menu/tabel.php"
                       class="btn btn-success">

                        Buka Modul

                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-3">

            <div class="card dashboard-card shadow">

                <div class="card-body text-center p-4">

                    <div class="icon-circle icon-gizi mb-3">
                        <i class="bi bi-heart-pulse"></i>
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

    <!-- Data Gabungan -->
    <div class="card glass-card shadow">

        <div class="card-header bg-success text-white fw-bold">
            Data Menu dan Kandungan Gizi Terbaru
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Menu</th>
                            <th>Jenis</th>
                            <th>Kalori</th>
                            <th>Protein</th>
                            <th>Lemak</th>
                            <th>Karbohidrat</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php if(mysqli_num_rows($dashboardQuery) > 0): ?>

                        <?php while($row = mysqli_fetch_assoc($dashboardQuery)): ?>

                        <tr>

                            <td><?= $row['id_menu']; ?></td>

                            <td>
                                <strong>
                                    <?= $row['nama_menu']; ?>
                                </strong>
                            </td>

                            <td>
                                <span class="badge-menu">
                                    <?= $row['jenis']; ?>
                                </span>
                            </td>

                            <td><?= $row['kalori'] ?? '-'; ?> kkal</td>
                            <td><?= $row['protein'] ?? '-'; ?> gr</td>
                            <td><?= $row['lemak'] ?? '-'; ?> gr</td>
                            <td><?= $row['karbohidrat'] ?? '-'; ?> gr</td>

                        </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7" class="text-center">
                                Belum ada data menu dan gizi
                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>

