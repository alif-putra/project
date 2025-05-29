<?php
session_start();
include 'inc/koneksi.php';

$id = $_GET['id'];
$produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id"));

if (!$produk) {
    echo "Produk tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['pembeli'])) {
        echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
        exit;
    }
    $jumlah = (int)$_POST['jumlah'];
    if ($jumlah < 1) $jumlah = 1;

    // Tambah ke keranjang session
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    // Jika produk sudah ada di keranjang, tambah jumlah
    if (isset($_SESSION['keranjang'][$id])) {
        $_SESSION['keranjang'][$id] += $jumlah;
    } else {
        $_SESSION['keranjang'][$id] = $jumlah;
    }

    echo "<script>alert('Produk berhasil ditambahkan ke keranjang!'); window.location='keranjang.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk - <?= $produk['nama'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="index.php">Siswa Care</a>
    <div class="d-flex">
        <?php if (isset($_SESSION['pembeli'])): ?>
            <span class="text-white me-3">Halo, <?= $_SESSION['nama']; ?>!</span>
            <a href="keranjang.php" class="btn btn-light btn-sm me-2">Keranjang</a>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-light btn-sm me-2">Login</a>
            <a href="register.php" class="btn btn-outline-light btn-sm">Daftar</a>
        <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container my-4">
    <div class="row">
        <div class="col-md-5">
            <img src="assets/images/<?= $produk['gambar'] ?>" class="img-fluid" alt="<?= $produk['nama'] ?>">
        </div>
        <div class="col-md-7">
            <h3><?= $produk['nama'] ?></h3>
            <p><?= nl2br($produk['deskripsi']) ?></p>
            <h4 class="text-danger">Rp<?= number_format($produk['harga']) ?></h4>
            <p>Stok: <?= $produk['stok'] ?></p>
            <form method="post" class="w-50">
                <input type="number" name="jumlah" class="form-control mb-3" value="1" min="1" max="<?= $produk['stok'] ?>" required>
                <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
            </form>
            <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Produk</a>
        </div>
    </div>
</div>
</body>
</html>
