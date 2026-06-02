<?php
session_start();
include '../config/koneksi.php';

$error = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM users WHERE username='$username'"
    );

    $user = mysqli_fetch_assoc($query);

    if($user && password_verify($password, $user['password'])){

        $_SESSION['username'] = $user['username'];

        header("Location: ../menu/tabel.php");
        exit;

    }else{

        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login SIM GIZI</title>

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
        SIM GIZI
    </h1>

    <p class="text-center text-gray-500 mb-6">
        Login Sistem
    </p>

    <?php if($error != ""): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?= $error ?>
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

        <button
            type="submit"
            name="login"
            class="w-full bg-green-600 text-white p-3 rounded">

            Login

        </button>

    </form>

    <div class="text-center mt-4">
        Belum punya akun?

        <a href="register.php"
           class="text-green-600 font-semibold">
            Register
        </a>
    </div>

</div>

</body>
</html>