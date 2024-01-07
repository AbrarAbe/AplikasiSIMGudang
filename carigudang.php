<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
} elseif ($_SESSION['Level'] === 'Operator') {
    header('Location: operator.php');
    exit;
} elseif ($_SESSION['Level'] === 'Umum') {
    header('Location: umum.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Cari Gudang - SIM Gudang</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
 <h2>Cari Gudang</h2>
 <form method="POST" action="">
    <div class="form-group row">
      <label for="KodeGudang" class="col-4 col-form-label">Kode Gudang</label> 
      <div class="col-8">
        <input id="KodeGudang" name="KodeGudang" type="text" class="form-control" required="required">
      </div>
    </div>
    <div class="form-group row mt-3 mb-3">
      <div class="offset-4 col-8">
        <a href="gudang.php" class="btn btn-success" style="margin-right: 10px;">Form Tabel Gudang</a>
        <button name="submit" type="submit" class="btn btn-primary">Cari Gudang</button>
      </div>
    </div>
 </form>
 <?php
if (isset($_POST['submit'])) {
  $KodeGudang = filter_var($_POST['KodeGudang'], FILTER_SANITIZE_STRING);
  include('koneksi.db.php');
  $sql = "SELECT * FROM `gudang` WHERE `KodeGudang`='" . $KodeGudang . "'";
  $q = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($q) > 0) {
    $row = mysqli_fetch_assoc($q);
    echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> Data gudang ditemukan !.
      </div>';
    echo '
      <div class="row">
        <div class="col-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Gudang</h5>
              <p class="card-text">
                Kode Gudang : ' . $row['KodeGudang'] . '<br>
                Nama Gudang : ' . $row['Alamat'] . '<br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Opsi</h5>
              <form method="POST" action="">
                <input type="hidden" name="kodegudang" value="' . $row['KodeGudang'] . '">
                <button name="ubah" type="submit" class="btn btn-primary">Ubah</button>
                <button name="hapus" type="submit" class="btn btn-danger">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </div>';
  } else {
    echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Gagal!</strong> Data gudang tidak ditemukan !.
      </div>';
  }
}

if (isset($_POST['hapus'])) {
  include('koneksi.db.php');
  $kodegudang = $_POST['kodegudang'];
  $sql = "DELETE FROM gudang WHERE KodeGudang='$kodegudang'";
  if (mysqli_query($koneksi, $sql)) {
    echo '<div class="alert alert-success alert-dismissible">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <strong>Hapus Gudang</strong> Berhasil menghapus gudang dengan kode ' . $kodegudang . '! </div>';
  } else {
    echo '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <strong>Hapus Gudang</strong> Gagal menghapus gudang dengan kode ' . $kodegudang . '! </div>';
  }
}
?>

</div>
</body>
</html>