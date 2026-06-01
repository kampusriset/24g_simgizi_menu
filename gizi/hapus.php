<?php
include '../config/koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "
DELETE FROM kandungan_gizi
WHERE id_gizi='$id'
");

header("Location: tabel.php");
?>