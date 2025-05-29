<?php
session_start();
include 'inc/koneksi.php';

if (!isset($_SESSION['pembeli'])) {
    header('Location: login.php');
    exit;
}

$keranjang = $_SESSION['keranjang'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="index.php">Siswa Care</a>
    <div class="d-flex">
        <span class="text-white me-3">Halo, <?= $_SESSION['nama']; ?>!</span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-4">
    <h2>Keranjang Belanja</h2>

    <?php if (empty($keranjang)): ?>
        <p>Keranjang Anda kosong.</p>
        <a href="index.php" class="btn btn-primary">Lanjut Belanja</a>
    <?php else: ?>
    <form method="post" action="checkout.php">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $total = 0;
            foreach ($keranjang as $id => $jumlah):
                $produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id"));
                if (!$produk) continue; // skip jika produk tidak ditemukan
                $subtotal = $produk['harga'] * $jumlah;
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($produk['nama']) ?></td>
                    <td>Rp<?= number_format($produk['harga']) ?></td>
                    <td>
                        <input type="number" name="jumlah[<?= $id ?>]" value="<?= $jumlah ?>" min="1" max="<?= $produk['stok'] ?>" class="form-control" style="width: 80px;">
                    </td>
                    <td>Rp<?= number_format($subtotal) ?></td>
                    <td><a href="hapus_keranjang.php?id=<?= $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk dari keranjang?')">Hapus</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th>Rp<?= number_format($total) ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <button type="submit" class="btn btn-success">Update Keranjang & Checkout</button>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
