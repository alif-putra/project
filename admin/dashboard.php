<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2>Selamat datang, <?= $_SESSION['admin']; ?>!</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <hr>
    <p><a href="../produk/tambah.php" class="btn btn-success">+ Tambah Produk</a></p>
    <!-- Nanti kita tampilkan daftar produk di sini -->
</body>
</html>
<?php
include '../inc/koneksi.php';
$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
?>

<h4 class="mt-4">Daftar Produk</h4>
<table class="table table-bordered">
    <tr>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php while($p = mysqli_fetch_assoc($produk)): ?>
    <tr>
        <td><img src="../assets/images/<?= $p['gambar']; ?>" width="50"></td>
        <td><?= $p['nama']; ?></td>
        <td>Rp<?= number_format($p['harga']); ?></td>
        <td><?= $p['stok']; ?></td>
        <td>
            <a href="../produk/edit.php?id=<?= $p['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="../produk/hapus.php?id=<?= $p['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
