<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Cari Gudang</title>
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
    <div class="form-group row" style="margin-top: 15px; margin-bottom: 15px;">
      <div class="offset-4 col-8">
        <button name="submit" type="submit" class="btn btn-primary">Cari Gudang</button>
      </div>
    </div>
 </form>
 <?php 
    if (isset($_POST['submit'])) {
      $KodeGudang=filter_var($_POST['KodeGudang'],FILTER_SANITIZE_STRING);
      include('koneksi.db.php');
      $sql="SELECT * FROM `gudang` WHERE `KodeGudang`='".$KodeGudang."'";
      $q=mysqli_query($koneksi,$sql);
      if (mysqli_num_rows($q)>0) {
        $row=mysqli_fetch_assoc($q);
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> Data Gudang ditemukan !.
      </div>';
      echo '
      <div class="row">
        <div class="col-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Gudang</h5>
              <p class="card-text">
                Kode Gudang : '.$row['KodeGudang'].'<br>
                Alamat : '.$row['Alamat'].'<br>
              </p>
            </div>
          </div>
        </div>
      </div>';
      } else {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Gagal!</strong> Data Gudang tidak ditemukan !.
      </div>';
      }
    }
    ?>
</div>
</body>
</html>