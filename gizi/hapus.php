<?php
require_once __DIR__ ."/../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "
DELETE FROM kandungan_gizi
WHERE id_gizi='$id'
");

header("Location: tabel.php");
?>