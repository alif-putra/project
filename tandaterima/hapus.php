<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Hard delete
$sql = "DELETE FROM barangterima WHERE IDTERIMA = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil dihapus.'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
?>
