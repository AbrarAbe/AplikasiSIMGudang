<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
} elseif ($_SESSION['Level'] === 'Admin') {
    header('Location: admin.php');
    exit;
} elseif ($_SESSION['Level'] === 'Umum') {
    header('Location: umum.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda Operator - SIM Gudang</title>
    <link rel="stylesheet" href="assets/css/abrar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<style>

body{
background-image: url('assets/images/gudang4.jpg');
background-size: cover;
}

</style>

<body>
    <section class="ftco-section apa">
        <div class="d-flex align-items-center justify-content-center login-container">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <h2>Selamat datang di Sistem Informasi Manajemen Gudang</h1>
                </div>
                <div class="row justify-content-center">
                    <h4>Anda telah login sebagai user Operator. Selamat Bekerja !</h2>
                </div>
            </div>
        </div>
    </section>
</body>
</html>