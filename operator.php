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

<html lang="en">
<head>
  <title>Operator - SIM Gudang</title>
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
            <img src="assets/images/line-chart.gif" width="100%" height="100%">
          </div>
          <div class="col-md-10 collapse navbar-collapse">
            <h2 style="color: white;">Sistem Informasi Manajemen Gudang</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-1">
    </div>
    <div class="col-md-4">
      <div class="collapse navbar-collapse margin-right" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="operator.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transaksibarang.php" target="frmmenu">Transaksi</a>
          </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Laporan</a>
          <ul class="dropdown-menu">
            <li><a style="color: #0766AD;" class="dropdown-item" href="daftarbarang.php" target="frmmenu">Daftar Barang</a></li>
            <li><a style="color: #0766AD;" class="dropdown-item" href="daftargudang.php" target="frmmenu">Daftar Gudang</a></li>
            <li><a style="color: #0766AD;" class="dropdown-item" href="rekapbarang.php" target="frmmenu">Rekap Barang</a></li>
          </ul>
          </li>	
        </ul>
        <a href="logout.php">Keluar</a>
      </div>
    </div>
  </nav>

  <div class="d-flex align-items-center justify-content-center login-container">
    <iframe src="menu_operator.php" name="frmmenu" width="100%" height="700vh"></iframe>
  </div>

</body>
</html>
