<?php
include '../config/koneksi.php';

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
</head>
<body>

<h2>Data Kandungan Gizi MBG</h2>

<a href="tambah.php">+ Tambah Data</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Menu</th>
        <th>Kalori</th>
        <th>Protein</th>
        <th>Lemak</th>
        <th>Karbohidrat</th>
        <th>Aksi</th>
    </tr>

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
        <a href="edit.php?id=<?= $data['id_gizi'] ?>">Edit</a>
        |
        <a href="hapus.php?id=<?= $data['id_gizi'] ?>" onclick="return confirm('Yakin hapus data?')">Hapus</a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>