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
<title>Daftar Gudang - SIM Gudang</title>
<script>
function deleteGudang(kodeGudang) {
  if (confirm("Anda yakin ingin menghapus gudang ini?")) {
    window.location.href = 'hapusgudang.php?kodeGudang=' + kodeGudang;
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
<h2>Daftar Gudang</h2>
<a href="gudang.php" class="btn btn-primary mb-3">Tambah Gudang</a>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari kode gudang.." title="Type in a name">

<table id="myTable">
  <tr class="header">
    <th style="width:20%;">Kode Gudang</th>
    <th style="width:65%;">Alamat</th>
    <th style="text-align:center; width:15%;">Opsi</th>
  </tr>
<?php include('koneksi.db.php');
$sql="select * from gudang";
$q=mysqli_query($koneksi,$sql);
$r=mysqli_fetch_array($q);
if (!empty($r)) {
do { ?>
  <tr>
    <td><?php echo $r['KodeGudang'];?></td>
    <td><?php echo $r['Alamat'];?></td>
    <td><button onclick="deleteGudang('<?php echo $r['KodeGudang']; ?>')" style="margin-left:25%" class="btn btn-danger">Hapus</button></td>
  </tr>
<?php } while($r=mysqli_fetch_array($q)); 
} else {
  echo "<h2>Gudang tidak ada !</h2>";
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
