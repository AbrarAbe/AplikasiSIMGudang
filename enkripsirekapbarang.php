<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
} elseif ($_SESSION['Level'] === 'Umum') {
    header('Location: umum.php');
    exit;
}
?>

<html>
<head>
<title>Enkripsi - SIM Gudang</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container" style="margin-top: 15px; margin-left: 15px; margin-right: 15px;">
<h2>Enkripsi Rekap Barang</h2>
<h5>Daftar Rekapitulasi Barang yang terenkripsi</h5>

<?php
include('koneksi.db.php');

$sql = "SELECT b.KodeBarang, b.NamaBarang, t.WaktuTransaksi, t.StatusTransaksi, t.Jumlah, g.Alamat
        FROM barang b
        INNER JOIN barangdigudang t ON b.KodeBarang = t.KodeBarang
        INNER JOIN gudang g ON t.KodeGudang = g.KodeGudang
        ORDER BY b.KodeBarang";

// Gunakan prepared statement
$stmt = mysqli_prepare($koneksi, $sql);

if ($stmt) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $KodeBarang, $NamaBarang, $WaktuTransaksi, $StatusTransaksi, $Jumlah, $Alamat);

    $algo = "AES-256-CBC";
    $option =0;
    $kunci = "tes";
    $iv = "1234567890112233";

    $arrahhasil = array();

    $enkripsi1 = openssl_encrypt($KodeBarang,$algo,$kunci,$option,$iv);
    $enkripsi2 = openssl_encrypt($NamaBarang,$algo,$kunci,$option,$iv);
    $enkripsi3 = openssl_encrypt($WaktuTransaksi,$algo,$kunci,$option,$iv);
    $enkripsi4 = openssl_encrypt($StatusTransaksi,$algo,$kunci,$option,$iv);
    $enkripsi5 = openssl_encrypt($Jumlah,$algo,$kunci,$option,$iv);
    $enkripsi6 = openssl_encrypt($Alamat,$algo,$kunci,$option,$iv);

    while (mysqli_stmt_fetch($stmt)) {
        $h = array();
        $h['KodeBarang'] = enkripaes($enkripsi1,$KodeBarang, $algo, $kunci, $iv);
        $h['NamaBarang'] = enkripaes($enkripsi2,$NamaBarang, $algo, $kunci, $iv);
        $h['WaktuTransaksi'] = enkripaes($enkripsi3,$WaktuTransaksi, $algo, $kunci, $iv);
        $h['StatusTransaksi'] = enkripaes($enkripsi4,$StatusTransaksi, $algo, $kunci, $iv);
        $h['Jumlah'] = enkripaes($enkripsi5,$Jumlah, $algo, $kunci, $iv);
        $h['Alamat'] = enkripaes($enkripsi6,$Alamat, $algo, $kunci, $iv);
        array_push($arrahhasil, $h);
    }

    mysqli_stmt_close($stmt);
    echo json_encode($arrahhasil);
} else {
    echo "Gagal mengeksekusi query.";
}

function enkripaes($data, $algo, $kunci, $iv) {
    // Implementasi fungsi enkripsi sesuai kebutuhan Anda
    // ...

    return $data;
}
?>

<?php 
$data=file_get_contents('http://localhost/gudangkita/jsonrekapbarang.php');
$arrahhasil=json_decode($data);
echo '<br>Hasil Array : <br>';
foreach($arrahhasil as $k) {
    echo 'Kode Barang : '.$k->KodeBarang."<br>";
    echo 'Nama Barang : '.$k->NamaBarang."<br>";
    echo 'Waktu Transaksi : '.$k->WaktuTransaksi."<br>";
    echo 'Status Transaksi : '.$k->StatusTransaksi."<br>";
    echo 'Jumlah : '.$k->Jumlah."<br>";
    echo 'Lokasi Gudang : '.$k->Alamat."<br>";
    echo 'Keterangan : '.$k->Keterangan."<br>";
}
?>
<br>
    <div>
        <a class="btn btn-dark" href="rekapbarang.php" target="frmmenu">Kembali</a>
    </div>
    </div>

</div>
</body>
</html>
