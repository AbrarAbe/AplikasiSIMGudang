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
  <title>Sistem Informasi Manajemen Gudang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="assets/js/web.webmanifest">
  <link rel="stylesheet" href="assets/css/nav.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
  <nav class="navbar navbar-expand-sm">
    <div class="col-md-7">
      <div class="container-fluid">
        <div class="navbar-brand1">
          <div class="col-md-2">
            <img src="assets/images/line-chart.gif" width="100px" height="100px">
          </div>
          <div class="col-md-10 collapse navbar-collapse">
            <h2 style="color: white;">Sistem Informasi Manajemen Gudang</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
    </div>
    <div class="col-md-3">
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Masuk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="daftarakun.php">Daftar</a>
            </li>
          </ul>
      </div>
    </div>
  </nav>

<div class="d-flex align-items-center justify-content-center login-container">
<iframe src="menu.php" name="frmmenu" width="100%" height="700vh"></iframe>
</div>

</body>
</html>
