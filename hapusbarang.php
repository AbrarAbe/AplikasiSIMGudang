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

<?php
if (isset($_GET['kodeBarang']) && !empty($_GET['kodeBarang'])) {
    include('koneksi.db.php');
    $sql = "DELETE FROM barang WHERE KodeBarang = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("s", $_GET['kodeBarang']);
        if ($stmt->execute()) {
            echo "Barang dengan KodeBarang = " . $_GET['kodeBarang'] . " berhasil dihapus.";
        } else {
            echo "Gagal menghapus barang.";
        }
        $stmt->close();
    } else {
        echo "Error yang tidak diketahui.";
    }
    $koneksi->close();
} else {
    echo "KodeBarang salah.";
}
?>
