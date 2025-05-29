<?php
session_start();
include '../inc/koneksi.php';
$id = $_GET['id'];

$produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id"));
unlink("../assets/images/" . $produk['gambar']);

mysqli_query($koneksi, "DELETE FROM produk WHERE id=$id");
header('Location: ../admin/dashboard.php');
