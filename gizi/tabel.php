<?php
require_once __DIR__ . "/../config/koneksi.php";
require_once __DIR__ . "/../auth/auth.php";

$query = mysqli_query(
    $koneksi,
    "SELECT kandungan_gizi.*, menu_makanan.nama_menu
    FROM kandungan_gizi
    LEFT JOIN menu_makanan
    ON kandungan_gizi.id_menu = menu_makanan.id_menu
    ORDER BY kandungan_gizi.id_gizi DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kandungan Gizi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    font-family:'Segoe UI',sans-serif;
    min-height:100vh;
    background:linear-gradient(
        135deg,
        #198754 0%,
        #20c997 40%,
        #42d392 100%
    );
    background-attachment:fixed;
}

.container{
    background:#ffffff;
    padding:30px;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

h2{
    color:#198754;
    font-weight:700;
}

.btn-success,
.btn-primary{
    border-radius:10px;
    font-weight:600;
}

.btn-outline-secondary{
    border-radius:10px;
}

.table{
    overflow:hidden;
    border-radius:12px;
    margin-top:20px;
}

.table thead{
    background:linear-gradient(
        135deg,
        #198754,
        #20c997
    );
    color:white;
}

.table thead th{
    border:none;
    text-align:center;
    vertical-align:middle;
}

.table tbody td{
    vertical-align:middle;
}

.table tbody tr{
    transition:.2s;
}

.table tbody tr:hover{
    background:#f2fff8;
}

.table-striped tbody tr:nth-of-type(odd){
    background:#f8fffb;
}

.btn-warning,
.btn-danger{
    border-radius:8px;
    font-weight:500;
}

.d-flex-header{
    border-bottom:2px solid #e9ecef;
    padding-bottom:15px;
    margin-bottom:25px;
}

.watermark-logo{
    position:fixed;
    top:50%;
    left:50%;
    width:350px;
    height:350px;
    background:url('https://i.pinimg.com/736x/37/2b/07/372b0749cdb041b9e33005ad77434fee.jpg') no-repeat center;
    background-size:cover;
    border-radius:70%;
    transform:translate(-50%,-50%);
    opacity:.06;
    pointer-events:none;
    z-index:-1;
}

body::before{
    content:'';
    position:fixed;
    top:-150px;
    right:-150px;
    width:400px;
    height:400px;
    background:rgba(255,255,255,.15);
    border-radius:50%;
    z-index:-1;
}

body::after{
    content:'';
    position:fixed;
    bottom:-200px;
    left:-200px;
    width:500px;
    height:500px;
    background:rgba(255,255,255,.1);
    border-radius:50%;
    z-index:-1;
}

@media(max-width:768px){

    .container{
        padding:20px;
    }

    h2{
        font-size:1.4rem;
    }

}
</style>

</head>
<body>

<div class="container mt-5">

    <div class="d-flex-header d-flex justify-content-between align-items-center">

        <h2>
            Data Kandungan Gizi MBG
        </h2>

        <div class="d-flex gap-2">

            <a href="../view/dashboard.php"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>
                Dashboard

            </a>

            <a href="tambah.php"
               class="btn btn-success">

                <i class="bi bi-plus-circle"></i>
                Tambah Data

            </a>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Kalori</th>
                    <th>Protein</th>
                    <th>Lemak</th>
                    <th>Karbohidrat</th>
                    <th width="220">Aksi</th>
                </tr>

            </thead>

            <tbody>

            <?php
            $no = 1;

            while($data = mysqli_fetch_assoc($query)):
            ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td>
                        <strong><?= $data['nama_menu']; ?></strong>
                    </td>

                    <td><?= $data['kalori']; ?> kkal</td>

                    <td><?= $data['protein']; ?> gr</td>

                    <td><?= $data['lemak']; ?> gr</td>

                    <td><?= $data['karbohidrat']; ?> gr</td>

                    <td class="text-center">

                        <a href="edit.php?id=<?= $data['id_gizi']; ?>"
                           class="btn btn-warning btn-sm">

                            <i class="bi bi-pencil-square"></i>
                            Edit

                        </a>

                        <a href="hapus.php?id=<?= $data['id_gizi']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data?')">

                            <i class="bi bi-trash"></i>
                            Hapus

                        </a>

                    </td>

                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

<div class="watermark-logo"></div>

</body>
</html>