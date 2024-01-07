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
if (isset($_GET['kodeGudang']) && !empty($_GET['kodeGudang'])) {
    include('koneksi.db.php');
    $sql = "DELETE FROM gudang WHERE KodeGudang = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("s", $_GET['kodeGudang']);
        if ($stmt->execute()) {
            echo "Gudang dengan KodeGudang = " . $_GET['kodeGudang'] . " berhasil dihapus.";
        } else {
            echo "Gagal menghapus gudang.";
        }
        $stmt->close();
    } else {
        echo "Error yang tidak diketahui.";
    }
    $koneksi->close();
} else {
    echo "KodeGudang salah.";
}
?>
