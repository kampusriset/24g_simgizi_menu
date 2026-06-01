<?php

include '../config/koneksi.php';

$id = $_GET['id'];

mysqli_query(
    $koneksi,
    "DELETE FROM menu_makanan
     WHERE id_menu='$id'"
);

header("Location: index.php");
exit;