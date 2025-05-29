<?php
include 'inc/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = md5($_POST['password']);
    $alamat   = $_POST['alamat'];
    $no_hp    = $_POST['no_hp'];

    $cek = mysqli_query($koneksi, "SELECT * FROM pembeli WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO pembeli (nama, email, password, alamat, no_hp)
            VALUES ('$nama', '$email', '$password', '$alamat', '$no_hp')");
        if ($query) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            echo "Gagal: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">
<div class="card p-4 shadow" style="width: 400px;">
    <h4 class="text-center mb-3">Daftar Pembeli</h4>
    <form method="post">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <textarea name="alamat" class="form-control mb-2" placeholder="Alamat" required></textarea>
        <input type="text" name="no_hp" class="form-control mb-3" placeholder="No HP" required>
        <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>
    <p class="text-center mt-2">Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
