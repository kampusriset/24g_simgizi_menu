<?php
require_once __DIR__ ."/../config/koneksi.php";

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
        max-width: 700px;
    }

    .card{
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .card-header{
        background: linear-gradient(135deg, #0d6efd, #3b82f6);
        color: white;
        border: none;
        padding: 20px 25px;
    }

    .card-header h3{
        margin: 0;
        font-weight: 700;
    }

    .card-body{
        padding: 30px;
        background: #ffffff;
    }

    .form-label{
        font-weight: 600;
        color: #495057;
    }

    .form-control,
    .form-select{
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #ced4da;
        transition: all 0.3s;
    }

    .form-control:focus,
    .form-select:focus{
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.15);
    }

    .btn-primary{
        background: #0d6efd;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-primary:hover{
        background: #0b5ed7;
        transform: translateY(-2px);
    }

    .btn-secondary{
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
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

    @media (max-width:768px){

        .container{
            padding: 15px;
        }

        .card-body{
            padding: 20px;
        }

        .btn{
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
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

                <a href="tabel.php"
                   class="btn btn-secondary">

                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

<div class="watermark-logo"></div>

</body>
</html>