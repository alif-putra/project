<?php
session_start();
include 'inc/koneksi.php';

if (!isset($_SESSION['pembeli'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah_post = $_POST['jumlah'] ?? [];

    // Update keranjang session sesuai input user
    foreach ($jumlah_post as $id => $qty) {
        $qty = (int)$qty;
        if ($qty < 1) $qty = 1;

        // Cek stok produk sebelum update
        $produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stok FROM produk WHERE id=$id"));
        if (!$produk) {
            echo "<script>alert('Produk dengan ID $id tidak ditemukan.'); window.location='keranjang.php';</script>";
            exit;
        }

        if ($qty > $produk['stok']) {
            echo "<script>alert('Jumlah produk melebihi stok tersedia.'); window.location='keranjang.php';</script>";
            exit;
        }

        $_SESSION['keranjang'][$id] = $qty;
    }

    $keranjang = $_SESSION['keranjang'];
    $id_pembeli = $_SESSION['pembeli'];
    $total_bayar = 0;

    mysqli_begin_transaction($koneksi);

    try {
        $tgl = date('Y-m-d H:i:s');
        // Insert transaksi dengan total sementara 0
        mysqli_query($koneksi, "INSERT INTO transaksi (id_pembeli, tanggal, total) VALUES ($id_pembeli, '$tgl', 0)");
        $id_transaksi = mysqli_insert_id($koneksi);

        foreach ($keranjang as $id_produk => $qty) {
            $produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id_produk"));

            if (!$produk) throw new Exception("Produk tidak ditemukan.");

            if ($produk['stok'] < $qty) {
                throw new Exception("Stok produk {$produk['nama']} tidak cukup.");
            }

            $subtotal = $produk['harga'] * $qty;
            $total_bayar += $subtotal;

            // Kurangi stok produk
            mysqli_query($koneksi, "UPDATE produk SET stok = stok - $qty WHERE id=$id_produk");

            // Insert detail transaksi
            mysqli_query($koneksi, "INSERT INTO detail_transaksi (id_transaksi, id_produk, jumlah, subtotal) 
                VALUES ($id_transaksi, $id_produk, $qty, $subtotal)");
        }

        // Update total transaksi
        mysqli_query($koneksi, "UPDATE transaksi SET total = $total_bayar WHERE id=$id_transaksi");

        mysqli_commit($koneksi);

        // Bersihkan keranjang
        unset($_SESSION['keranjang']);

        echo "<script>alert('Pembelian berhasil! Terima kasih.'); window.location='index.php';</script>";
    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        echo "<script>alert('Gagal melakukan pembelian: " . $e->getMessage() . "'); window.location='keranjang.php';</script>";
    }
} else {
    header('Location: keranjang.php');
    exit;
}
