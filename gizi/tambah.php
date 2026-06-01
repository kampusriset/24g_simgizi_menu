<?php
include '../config/koneksi.php';

if(isset($_POST['simpan'])){

    $id_menu      = $_POST['id_menu'];
    $kalori       = $_POST['kalori'];
    $protein      = $_POST['protein'];
    $lemak        = $_POST['lemak'];
    $karbohidrat  = $_POST['karbohidrat'];

    mysqli_query($koneksi, "
    INSERT INTO kandungan_gizi
    (id_menu, kalori, protein, lemak, karbohidrat)

    VALUES
    ('$id_menu', '$kalori', '$protein', '$lemak', '$karbohidrat')
    ");

    header("Location: tabel.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Gizi</title>
</head>
<body>

<h2>Tambah Kandungan Gizi</h2>

<form method="POST">

    <label>Menu Makanan</label>
    <br>

    <select name="id_menu" required>

        <option value="">-- Pilih Menu --</option>

        <?php
        $menu = mysqli_query($koneksi, "SELECT * FROM menu_makanan");

        while($m = mysqli_fetch_array($menu)){
        ?>

        <option value="<?= $m['id_menu'] ?>">
            <?= $m['nama_menu'] ?>
        </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Kalori</label>
    <br>
    <input type="number" step="0.01" name="kalori" required>

    <br><br>

    <label>Protein</label>
    <br>
    <input type="number" step="0.01" name="protein" required>

    <br><br>

    <label>Lemak</label>
    <br>
    <input type="number" step="0.01" name="lemak" required>

    <br><br>

    <label>Karbohidrat</label>
    <br>
    <input type="number" step="0.01" name="karbohidrat" required>

    <br><br>

    <button type="submit" name="simpan">Simpan</button>

</form>

</body>
</html>