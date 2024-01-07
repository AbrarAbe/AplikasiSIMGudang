<!DOCTYPE html>

<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SESSION['Level'] === 'Admin') {
        header('Location: admin.php');
        exit;
    } elseif ($_SESSION['Level'] === 'Operator') {
        header('Location: operator.php');
        exit;
    } elseif ($_SESSION['Level'] === 'Umum') {
        header('Location: umum.php');
        exit;
    }
}
require('koneksi.db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $KodeLogin = $_POST['KodeLogin'];
    $Password = $_POST['Password'];
    $sql = "SELECT `KodeLogin`, `Password`, `Level` FROM `pengguna` WHERE KodeLogin = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param('s', $KodeLogin);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($KodeLogin, $stored_password, $Level);
        if ($stmt->fetch()) {
            if ($Password == $stored_password) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['KodeLogin'] = $KodeLogin;
                $_SESSION['Level'] = $Level;
                if ($Level == 'Admin') {
                    header('Location: admin.php');
                } elseif ($Level == 'Operator') {
                    header('Location: operator.php');
                } elseif ($Level == 'Umum') {
                    header('Location: umum.php');
                }
            } else {
                echo 'Password Salah';
            }
        }
    } else {
        echo 'Kode Login salah';
    }
    $stmt->close();
    $koneksi->close();
}
?>

<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login - SIM Gudang</title>
 <link rel="stylesheet" href="assets/css/abrar.css">
 <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<style>

body{
background-image: url('assets/images/gudang.jpg');
background-size: cover;
}

</style>

<body>

<section class="ftco-section apa">
	<div class="d-flex align-items-center justify-content-center login-container">
		<div class="container-fluid">
		<div class="row justify-content-center">
				<h2 class="heading-section margin60">Sistem Informasi Manajemen Gudang</h2>
			</div>
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-4">
				<div class="login-wrap p-0">
				<h3 class="mb-4 text-center">Masukkan Data Anda</h3>
				<form action="" method="post" class="signin-form">
					<div class="form-group">
					<input id="KodeLogin" type="text" name="KodeLogin" class="form-control" placeholder="Kode Login" required>
					</div>
					<div class="form-group">
					<input id="Password" type="password" name="Password" class="form-control" placeholder="Password" required>
					<span toggle="#Password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					</div>
					<div class="form-group">
					<button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Masuk</button>
					</div>
					<div class="form-group d-md-flex">
					<div class="w-50 text-left">
						<label class="alabel">Ingat Saya
						<input type="checkbox" checked>
						<span class="checkmark"></span>
						</label>
					</div>
					<div class="w-50 text-md-right">
						<a href="#">Lupa Password</a>
					</div>
					</div>
				</form>
				</div>
			</div>
			<div class="col-md-4 text-center mb-4">
				<h2 class="heading-section">Masuk</h2>
				<label class="alabel">Belum punya akun? Silahkan daftar terlebih dahulu</label>
				<div class="margin15">
					<a href="daftarakun.php" class="btn btn-primary">Daftar</a>
				</div>
				<label class="alabel">atau</label>
				<div class="margin15">
					<a href="index.php" class="btn btn-success">Kembali ke beranda</a>
				</div>
			</div>
			</div>
			</div>
		</div>
	</div>
</section>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>