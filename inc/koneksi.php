<?php
$koneksi = mysqli_connect("localhost", "root", "", "toko_online");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
