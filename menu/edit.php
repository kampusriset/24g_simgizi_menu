<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM menu_makanan WHERE id_menu='$id'"
);

$menu = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama_menu = $_POST['nama_menu'];
    $jenis = $_POST['jenis'];
    $tanggal_menu = $_POST['tanggal_menu'];

    mysqli_query(
        $koneksi,
        "UPDATE menu_makanan SET
            nama_menu='$nama_menu',
            jenis='$jenis',
            tanggal_menu='$tanggal_menu'
        WHERE id_menu='$id'"
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header">
            <h3>Edit Menu Makanan</h3>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label>Nama Menu</label>

                    <input
                        type="text"
                        name="nama_menu"
                        class="form-control"
                        value="<?= $menu['nama_menu']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label>Jenis</label>

                    <select
                        name="jenis"
                        class="form-select">

                        <option value="Sarapan"
                            <?= ($menu['jenis']=='Sarapan') ? 'selected' : ''; ?>>
                            Sarapan
                        </option>

                        <option value="Siang"
                            <?= ($menu['jenis']=='Siang') ? 'selected' : ''; ?>>
                            Siang
                        </option>

                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Menu</label>

                    <input
                        type="date"
                        name="tanggal_menu"
                        class="form-control"
                        value="<?= $menu['tanggal_menu']; ?>"
                        required>
                </div>

                <button
                    type="submit"
                    name="update"
                    class="btn btn-warning">

                    Update
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