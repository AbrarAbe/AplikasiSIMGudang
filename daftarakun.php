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
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Daftar - SIM Gudang</title>
 <link rel="stylesheet" href="assets/css/abrar.css">
 <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<style>

body{
background-image: url('assets/images/gudang2.jpg');
background-size: cover
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
					<select name="Level" id="Level" class="form-control">
						<option value="Admin">Admin</option>
						<option value="Operator">Operator</option>
						<option value="Umum">Umum</option>
					</select>
					</div>
					<div class="form-group">
					<button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Daftar</button>
					</div>
					<div class="form-group d-md-flex">
					<div class="w-100 text-left">
						<label class="alabel">Dengan mendaftar anda menyetujui Syarat & Ketentuan kami
						<input type="checkbox" unchecked required>
						<span class="checkmark"></span>
						</label>
					</div>
					</div>
				</form>
<?php

if (isset($_POST['submit'])) {
    $KodeLogin = filter_var($_POST['KodeLogin'], FILTER_SANITIZE_STRING);
    $Password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
    $Level = filter_var($_POST['Level'], FILTER_SANITIZE_STRING);
	include('koneksi.db.php');
    $sql = "SELECT * FROM pengguna WHERE KodeLogin = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("s", $KodeLogin);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> KodeLogin sudah ada.
            </div>';
        } else {
            $sql = "INSERT INTO pengguna (KodeLogin, Password, Level) VALUES (?, ?, ?)";
            if ($stmt = $koneksi->prepare($sql)) {
                $stmt->bind_param("sss", $KodeLogin, $Password, $Level);
                if ($stmt->execute()) {
                    echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Berhasil!</strong> Akun anda berhasil terdaftar! Anda dapat <a href="login.php">Masuk</a> sekarang.
                    </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Gagal!</strong> Gagal daftar akun. Harap ulangi lagi!
                    </div>';
                }
                $stmt->close();
            } else {
                echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> Error yang tidak diketahui.
                </div>';
            }
        }
    }
}

?>
				</div>
			</div>
				<div class="col-md-4 text-center mb-4">
				<h2 class="heading-section">Daftar</h2>
				<label class="alabel"> Sudah punya akun? Silahkan masuk ke akun anda</label>
				<div class="margin15">
					<a href="login.php" class="btn btn-primary">Masuk</a>
				</div>
				<label class="alabel"> atau</label>
				<div class="margin15">
					<a href="index.php" class="btn btn-success">Kembali ke beranda</a>
				</div>
			</div>
			</div>
		</div>
	</div>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>