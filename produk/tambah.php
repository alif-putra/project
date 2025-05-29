<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../admin/login.php');
    exit;
}

include '../inc/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga    = $_POST['harga'];
    $stok     = $_POST['stok'];
    $gambar   = $_FILES['gambar']['name'];
    $tmp      = $_FILES['gambar']['tmp_name'];

    if ($gambar != '') {
        move_uploaded_file($tmp, "../assets/images/$gambar");
    }

    $query = mysqli_query($koneksi, "INSERT INTO produk (nama, deskripsi, harga, stok, gambar)
              VALUES ('$nama', '$deskripsi', '$harga', '$stok', '$gambar')");

    if ($query) {
        header('Location: ../admin/dashboard.php');
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3>Tambah Produk</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Produk" required>
        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi" required></textarea>
        <input type="number" name="harga" class="form-control mb-2" placeholder="Harga" required>
        <input type="number" name="stok" class="form-control mb-2" placeholder="Stok" required>
        <input type="file" name="gambar" class="form-control mb-3" required>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="../admin/dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>
