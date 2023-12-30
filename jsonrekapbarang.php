<?php include('koneksi.db.php');
$sql = "select b.*,g.*,t.* from barang b inner join barangdigudang t on b.KodeBarang=t.KodeBarang inner join gudang g on t.KodeGudang=g.KodeGudang order by b.KodeBarang";
$q=mysqli_query($koneksi,$sql);
$r=mysqli_fetch_assoc($q);
$arrayhasil=array();
do {
    $arrayhasil=$r;
}while($r=mysqli_fetch_assoc($q));
echo json_encode($arrayhasil);
?>