<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn, "
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

    mysqli_query($conn, "
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
</head>
<body>

<h2>Edit Kandungan Gizi</h2>

<form method="POST">

<label>Menu Makanan</label>
<br>

<select name="id_menu" required>

<?php
$menu = mysqli_query($conn, "SELECT * FROM menu_makanan");

while($m = mysqli_fetch_array($menu)){
?>

<option value="<?= $m['id_menu'] ?>"
    <?php
    if($m['id_menu'] == $d['id_menu']){
        echo "selected";
    }
    ?>
>
    <?= $m['nama_menu'] ?>
</option>

<?php } ?>

</select>

<br><br>

<label>Kalori</label>
<br>
<input type="number" step="0.01" name="kalori"
value="<?= $d['kalori'] ?>">

<br><br>

<label>Protein</label>
<br>
<input type="number" step="0.01" name="protein"
value="<?= $d['protein'] ?>">

<br><br>

<label>Lemak</label>
<br>
<input type="number" step="0.01" name="lemak"
value="<?= $d['lemak'] ?>">

<br><br>

<label>Karbohidrat</label>
<br>
<input type="number" step="0.01" name="karbohidrat"
value="<?= $d['karbohidrat'] ?>">

<br><br>

<button type="submit" name="update">Update</button>

</form>

</body>
</html>