<?php
include '../config/koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "
DELETE FROM kandungan_gizi
WHERE id_gizi='$id'
");

header("Location: tabel.php");
?>