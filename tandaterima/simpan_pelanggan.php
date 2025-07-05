<?php
include 'koneksi.php';

$nama    = $_POST['nama'];
$alamat  = $_POST['alamat'];
$jk      = $_POST['jk'];
$telp1   = $_POST['telp1'];

$email   = $_POST['email'];
$now     = date('Y-m-d H:i:s');
$user    = 'admin'; // bisa diganti sesuai sistem login

$sql = "INSERT INTO pelanggan (NAMA, ALAMAT, JENISKELAMIN, TELEPON1, EMAIL, USERRECORD, USERMODIFIED, DATERECORD, DATEMODIFIED, VOID)
        VALUES ('$nama', '$alamat', '$jk', '$telp1', '$email', '$user', '$user', '$now', '$now', 0)";

if (mysqli_query($conn, $sql)) {
    $id = mysqli_insert_id($conn);
    header("Location: simpan_barang.php?id=$id");
    exit;
} else {
    echo "Gagal menyimpan data pelanggan: " . mysqli_error($conn);
}
?>
