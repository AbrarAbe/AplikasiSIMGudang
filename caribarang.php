<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Hasil Cari Barang - SIM Gudang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/abrar.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  
<div class="container" style="margin-top: 15px;">
  <h1>Form Hasil Cari Barang</h1>
<form method="post">
  <div class="form-group row">
    <label for="KodeBarang" class="col-4 col-form-label">Kode Barang</label> 
    <div class="col-8">
      <input id="KodeBarang" name="KodeBarang" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="NamaBarang" class="col-4 col-form-label">Nama Barang</label> 
    <div class="col-8">
      <input id="NamaBarang" name="NamaBarang" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="JumlahStok" class="col-4 col-form-label">Jumlah Stok</label> 
    <div class="col-8">
      <input id="JumlahStok" name="JumlahStok" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Harga</label> 
    <div class="col-8">
      <input id="Harga" name="Harga" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="Satuan" class="col-4 col-form-label">Satuan</label> 
    <div class="col-8">
      <input id="Satuan" name="Satuan" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="TglAuditTerakhir" class="col-4 col-form-label">Tgl. Audit Terakhir</label> 
    <div class="col-8">
      <input id="TglAuditTerakhir" name="TglAuditTerakhir" type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
    </div>
  </div> 
  <div class="form-group row" style="margin-top: 15px;">
  <div class="offset-4 col-8 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Simpan Hasil Koreksi Barang</button>
      <button href="" class="btn btn-success">Hapus Barang</button>
      <a href="barang.php" class="btn btn-primary">Form Barang</a>
    </div>
  </div>
</form>
<?php 
if (isset($_POST['KodeBarang'])) {
    $KodeBarang=filter_var($_POST['KodeBarang'],FILTER_SANITIZE_STRING);
    include('koneksi.db.php');
    $sql="select * from barang where KodeBarang = '".$KodeBarang."'";
    $q=mysqli_query($koneksi,$sql);
    $r=mysqli_fetch_array($q);
    if (!empty($r)) {
        echo $r['NamaBarang'];   
    } else {
        echo 'Barang tidak ditemukan !';
    }
    mysqli_close($koneksi);
}
?>
</div>
</body>
</html>