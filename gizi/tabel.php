<?php
require_once __DIR__ ."/../config/koneksi.php";

$query = mysqli_query($koneksi, "
SELECT kandungan_gizi.*, menu_makanan.nama_menu
FROM kandungan_gizi
LEFT JOIN menu_makanan 
ON kandungan_gizi.id_menu = menu_makanan.id_menu
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kandungan Gizi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
    background: linear-gradient(
        135deg,
        #87ceeb 0%,
        #5dabd4 35%,
        #5dabd4 70%,
        #3e8dbe 100%
    );
    background-attachment: fixed;
    }

    .container{
        background: #ffffff;
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    h2{
        color: #0d6efd;
        font-weight: 700;
        margin-bottom: 0;
    }

    .btn-primary{
        background: #0d6efd;
        border: none;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-primary:hover{
        background: #0b5ed7;
        transform: translateY(-2px);
    }

    .table{
        overflow: hidden;
        border-radius: 12px;
        margin-top: 20px;
    }

    .table thead{
        background: linear-gradient(135deg, #0d6efd, #3b82f6);
        color: white;
    }

    .table thead th{
        border: none;
        text-align: center;
        vertical-align: middle;
    }

    .table tbody td{
        vertical-align: middle;
    }

    .table tbody tr{
        transition: 0.2s;
    }

    .table tbody tr:hover{
        background-color: #eef5ff;
    }

    .btn-warning{
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-danger{
        border-radius: 8px;
        font-weight: 500;
    }

    .d-flex{
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 15px;
        margin-bottom: 25px !important;
    }

    .table-striped tbody tr:nth-of-type(odd){
        background-color: #f8fbff;
    }

    @media (max-width:768px){
        .container{
            padding:20px;
        }

        h2{
            font-size:1.4rem;
        }
    }

    body::before{
        content:'';
        position:fixed;
        top:-150px;
        right:-150px;
        width:400px;
        height:400px;
        background:rgba(255,255,255,0.15);
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
        background:rgba(255,255,255,0.1);
        border-radius:50%;
        z-index:-1;
    }

    .watermark-logo{
        position: fixed;
        top: 50%;
        left: 50%;

        width: 350px;
        height: 350px;

        background: url('https://i.pinimg.com/736x/37/2b/07/372b0749cdb041b9e33005ad77434fee.jpg') no-repeat center;
        background-size: cover;

        border-radius: 70%; 

        transform: translate(-50%, -50%);
        opacity: 0.08;

        pointer-events: none;
        z-index: -1;
    }
</style>
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Data Kandungan Gizi MBG</h2>

        <a href="tambah.php" class="btn btn-primary">
            + Tambah Data
        </a>

    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Kalori</th>
                <th>Protein</th>
                <th>Lemak</th>
                <th>Karbohidrat</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>

        <?php
        $no = 1;

        while($data = mysqli_fetch_array($query)){
        ?>

        <tr>

            <td><?= $no++ ?></td>
            <td><?= $data['nama_menu'] ?></td>
            <td><?= $data['kalori'] ?></td>
            <td><?= $data['protein'] ?></td>
            <td><?= $data['lemak'] ?></td>
            <td><?= $data['karbohidrat'] ?></td>

            <td>

                <a href="edit.php?id=<?= $data['id_gizi'] ?>"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="hapus.php?id=<?= $data['id_gizi'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus data?')">
                    Hapus
                </a>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<div class="watermark-logo"></div>

</body>
</html>