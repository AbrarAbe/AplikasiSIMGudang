<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Daftar Barang - SIM Gudang</title>
<script>
function deleteBarang(kodeBarang) {
  if (confirm("Anda yakin ingin menghapus barang ini?")) {
    window.location.href = 'hapusbarang.php?kodeBarang=' + kodeBarang;
  }
}
</script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<script src="assets/js/bootstrap.bundle.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>
<body>

<div class="container mt-5">
<h2>Daftar Barang</h2>
<a href="barang.php" class="btn btn-primary mb-3">Tambah Barang</a>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari kode barang.." title="Type in a name">

<table id="myTable">
  <tr class="header">
    <th style="width:20%;">Kode Barang</th>
    <th style="width:30%;">Nama Barang</th>
    <th style="width:15%;">Jumlah Stok</th>
    <th style="width:10%;">Satuan</th>
    <th style="width:10%;">Harga</th>
    <th style="text-align:center; width:15%;">Opsi</th>
  </tr>
<?php include('koneksi.db.php');
$sql="select * from barang";
$q=mysqli_query($koneksi,$sql);
$r=mysqli_fetch_array($q);
if (!empty($r)) {
do { ?>
  <tr>
    <td><?php echo $r['KodeBarang'];?></td>
    <td><?php echo $r['NamaBarang'];?></td>
    <td><?php echo $r['JumlahStok'];?></td>
    <td><?php echo $r['Satuan'];?></td>
    <td>Rp<?php echo $r['Harga'];?></td>
    <td><button onclick="deleteBarang('<?php echo $r['KodeBarang']; ?>')" style="margin-left:25%" class="btn btn-danger">Hapus</button></td>
  </tr>
<?php } while($r=mysqli_fetch_array($q)); 
} else {
  echo "<h2>Barang tidak ada !</h2>";
}?> 
  
</table>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

</div>
</body>
</html>
