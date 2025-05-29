<?php
session_start();
include '../inc/koneksi.php';
$id = $_GET['id'];
$produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama      = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga     = $_POST['harga'];
    $stok      = $_POST['stok'];

    $gambar_lama = $produk['gambar'];
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if ($gambar != '') {
        move_uploaded_file($tmp, "../assets/images/$gambar");
    } else {
        $gambar = $gambar_lama;
    }

    $query = mysqli_query($koneksi, "UPDATE produk SET 
        nama='$nama', deskripsi='$deskripsi', harga='$harga', stok='$stok', gambar='$gambar'
        WHERE id=$id");

    if ($query) {
        header('Location: ../admin/dashboard.php');
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<h3>Edit Produk</h3>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="nama" class="form-control mb-2" value="<?= $produk['nama'] ?>" required>
    <textarea name="deskripsi" class="form-control mb-2" required><?= $produk['deskripsi'] ?></textarea>
    <input type="number" name="harga" class="form-control mb-2" value="<?= $produk['harga'] ?>" required>
    <input type="number" name="stok" class="form-control mb-2" value="<?= $produk['stok'] ?>" required>
    <p>Gambar saat ini: <br><img src="../assets/images/<?= $produk['gambar'] ?>" width="100"></p>
    <input type="file" name="gambar" class="form-control mb-3">
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="../admin/dashboard.php" class="btn btn-secondary">Batal</a>
</form>
</body>
</html>

