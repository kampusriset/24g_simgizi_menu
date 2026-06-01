<?php
include '../config/koneksi.php';

$pesan = "";

if(isset($_POST['register'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $konfirmasi = trim($_POST['konfirmasi']);

    if($password != $konfirmasi){

        $pesan = "Konfirmasi password tidak cocok!";

    }else{

        $cek = mysqli_query(
            $koneksi,
            "SELECT * FROM users
             WHERE username='$username'"
        );

        if(mysqli_num_rows($cek) > 0){

            $pesan = "Username sudah digunakan!";

        }else{

            $hash = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            mysqli_query(
                $koneksi,
                "INSERT INTO users
                (username,password)
                VALUES
                ('$username','$hash')"
            );

            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register SIM GIZI</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
    background: linear-gradient(
        135deg,
        #e8f5e9 0%,
        #c8e6c9 50%,
        #81c784 100%
    );
}
</style>

</head>
<body class="min-h-screen flex items-center justify-center">

<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">

    <h1 class="text-3xl font-bold text-center text-green-700 mb-2">
        Register
    </h1>

    <p class="text-center text-gray-500 mb-6">
        Buat Akun Baru
    </p>

    <?php if($pesan != ""): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?= $pesan ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <input
            type="text"
            name="username"
            placeholder="Username"
            class="w-full border p-3 rounded mb-4"
            required>

        <input
            type="password"
            name="password"
            placeholder="Password"
            class="w-full border p-3 rounded mb-4"
            required>

        <input
            type="password"
            name="konfirmasi"
            placeholder="Konfirmasi Password"
            class="w-full border p-3 rounded mb-4"
            required>

        <button
            type="submit"
            name="register"
            class="w-full bg-green-600 text-white p-3 rounded">

            Register

        </button>

    </form>

    <div class="text-center mt-4">

        Sudah punya akun?

        <a href="login.php"
           class="text-green-600 font-semibold">

            Login

        </a>

    </div>

</div>

</body>
</html>