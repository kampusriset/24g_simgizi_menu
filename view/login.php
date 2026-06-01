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
    background: url("https://scontent-cgk2-1.xx.fbcdn.net/v/t39.30808-6/471657498_122097124856703521_3649779445354297923_n.png?_nc_cat=106&ccb=1-7&_nc_sid=cc71e4&_nc_eui2=AeEh19aYsaVWo744a4imCqCXf7gdVHKtC0J_uB1Ucq0LQrfd5qRP7T5eTQ69sqt9PHgg7N7XQMAm-MVKYyzwQyig&_nc_ohc=fzmwLW3AVsIQ7kNvwH36J0Y&_nc_oc=AdoWKKDPGCy4KcGf0CMtVDjMrgxmmuIBxI3QsYf-21oKrL0bZhfjnnSSUy223jLOzV0&_nc_zt=23&_nc_ht=scontent-cgk2-1.xx&_nc_gid=UhQXNTUCUd7JzTRtr_9dbw&_nc_ss=7b2a8&oh=00_Af9Xl_1yogVXQVfPckVOyErqgyitQS-eetyZtPctlSdH_g&oe=6A232AE1");
    background-size: cover;
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