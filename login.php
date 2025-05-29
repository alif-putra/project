<?php
session_start();
include 'inc/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM pembeli WHERE email='$email' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['pembeli'] = $data['id']; // Simpan ID pembeli
        $_SESSION['nama'] = $data['nama'];  // Simpan nama
        header('Location: index.php');
        exit;
    } else {
        echo "<script>alert('Login gagal! Email atau password salah.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height:100vh;">
<div class="card p-4 shadow" style="width: 350px;">
    <h4 class="text-center mb-3">Login Pembeli</h4>
    <form method="post">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="text-center mt-2">Belum punya akun? <a href="register.php">Daftar</a></p>
</div>
</body>
</html>
