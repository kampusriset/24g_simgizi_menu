<?php
require_once __DIR__ ."/../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "
SELECT * FROM kandungan_gizi
WHERE id_gizi='$id'
");

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    $id_menu      = $_POST['id_menu'];
    $kalori       = $_POST['kalori'];
    $protein      = $_POST['protein'];
    $lemak        = $_POST['lemak'];
    $karbohidrat  = $_POST['karbohidrat'];

    mysqli_query($koneksi, "
    UPDATE kandungan_gizi SET
    id_menu='$id_menu',
    kalori='$kalori',
    protein='$protein',
    lemak='$lemak',
    karbohidrat='$karbohidrat'
    WHERE id_gizi='$id'
    ");

    header("Location: tabel.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Gizi</title>
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
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
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
        transition: all .3s;
    }

    .form-control:focus,
    .form-select:focus{
        border-color: #f59e0b;
        box-shadow: 0 0 0 0.2rem rgba(245,158,11,.15);
    }

    .btn-warning{
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        color: white;
    }

    .btn-warning:hover{
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
            <h3>Edit Kandungan Gizi</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">
                        Menu Makanan
                    </label>

                    <select
                        name="id_menu"
                        class="form-select"
                        required>

                        <?php
                        $menu = mysqli_query($koneksi, "SELECT * FROM menu_makanan");

                        while($m = mysqli_fetch_array($menu)){
                        ?>

                        <option
                            value="<?= $m['id_menu'] ?>"
                            <?= ($m['id_menu'] == $d['id_menu']) ? 'selected' : ''; ?>>

                            <?= $m['nama_menu'] ?>

                        </option>

                        <?php } ?>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Kalori (kkal)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="kalori"
                        class="form-control"
                        value="<?= $d['kalori'] ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Protein (gram)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="protein"
                        class="form-control"
                        value="<?= $d['protein'] ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Lemak (gram)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="lemak"
                        class="form-control"
                        value="<?= $d['lemak'] ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Karbohidrat (gram)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="karbohidrat"
                        class="form-control"
                        value="<?= $d['karbohidrat'] ?>"
                        required>
                </div>

                <button
                    type="submit"
                    name="update"
                    class="btn btn-warning">

                    Update Data
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