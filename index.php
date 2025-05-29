<?php
session_start();
include 'inc/koneksi.php';
$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Siswa Care - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="#">Siswa Care</a>
    <div class="d-flex">
        <?php if (isset($_SESSION['pembeli'])): ?>
            <span class="text-white me-3">Halo, <?= $_SESSION['nama']; ?>!</span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-light btn-sm me-2">Login</a>
            <a href="register.php" class="btn btn-outline-light btn-sm">Daftar</a>
        <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Daftar Produk -->
<div class="container my-4">
    <h2 class="text-center mb-4">Daftar Produk</h2>
    <div class="row">
        <?php while($p = mysqli_fetch_assoc($produk)): ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="assets/images/<?= $p['gambar'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?= $p['nama'] ?></h5>
                    <p class="card-text text-danger fw-bold">Rp<?= number_format($p['harga']) ?></p>
                    <a href="detail.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
