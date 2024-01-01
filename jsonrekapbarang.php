<?php include('koneksi.db.php');
$sql = "select b.*,g.*,t.* from barang b inner join barangdigudang t on b.KodeBarang=t.KodeBarang inner join gudang g on t.KodeGudang=g.KodeGudang order by b.KodeBarang";
$q=mysqli_query($koneksi,$sql);
$r=mysqli_fetch_assoc($q);
$arrahhasil=array();$h=array();
do {
    $h['KodeBarang']=$r['KodeBarang'];
    $h['NamaBarang']=$r['NamaBarang'];
    $h['WaktuTransaksi']=$r['WaktuTransaksi'];
    $h['StatusTransaksi']=$r['StatusTransaksi'];
    $h['Jumlah']=$r['Jumlah'];
    $h['Alamat']=$r['Alamat'];
    array_push($arrahhasil,$h);
}while($r=mysqli_fetch_assoc($q));
echo json_encode($arrahhasil);
?>