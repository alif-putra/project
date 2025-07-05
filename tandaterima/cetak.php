<?php
include 'koneksi.php';
$id = $_GET['idpel'] ?? 0;

$pel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE ID = $id"));
$bar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barangterima WHERE ID = $id ORDER BY IDTERIMA DESC LIMIT 1"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tanda Pembayaran Service</title>
  <style>
    @media print {
      @page {
        size: 148mm 210mm; /* A5 portrait */
        margin: 1cm;
      }
      .noprint {
        display: none;
      }
      body {
        margin: 0;
      }
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 40px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      border-bottom: 2px solid black;
      padding-bottom: 10px;
    }

    .logo {
      width: 100px;
    }

    .company-info {
      font-weight: bold;
      font-size: 18px;
    }

    .alamat {
      font-size: 10px;
      font-weight: normal;
    }

    .tanda {
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
      font-size: 20px;
    }

    .form-data {
      margin-top: 20px;
    }

    .form-data div {
      margin-bottom: 8px; /* jarak antar kalimat */
      line-height: 1.5;
    }

    .form-data span {
      display: inline-block;
      width: 150px;
    }

    .garansi {
      margin-top: 30px;
      font-size: 14px;
      text-align: center;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.6;
      font-style: italic;
    }

    .ttd {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }

    .ttd div {
      text-align: center;
      width: 40%;
    }

    .kanan {
      text-align: right;
      color: rgb(243, 79, 79);
      font-size: 14px;
    }

    .noprint {
      text-align: center;
      margin-top: 30px;
    }

    .noprint button {
      padding: 10px 20px;
      font-size: 16px;
      margin: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="header">
  <div style="display: flex; align-items: center;">
    <img class="logo" src="neev.jpeg" alt="Logo" style="margin-right: 10px;">
    <div class="company-info">
      <div style="font-size: 22px; font-weight: bold;">CV NEEV SOLUSINDO</div>
      <div class="alamat">
        <div style="color: red;">Konsultan IT, Software, CCTV, Jaringan, & Multimedia</div>
        Jl. Raya Kauman No.137, Kauman, Ketetang, Kec. Kwanyar, Kab. Bangkalan, Jawa Timur<br>
        Email: neework@gmail.com | Web: www.neework.com<br>
        Tlp: 082331875054
      </div>
    </div>
  </div>
  <div class="kanan" style="font-size: 15px; font-weight: bold;">
    ID: <?= date('y-m-') ?><?= str_pad($pel['ID'], 3, '0', STR_PAD_LEFT) ?>
  </div>
</div>

<div class="tanda">
  TANDA PEMBAYARAN SERVICE
</div>

<div class="form-data">
  <div><span>Jenis</span>: <?= $bar['JENISBARANG'] ?></div>
  <div><span>User</span>: <?= $pel['NAMA'] ?></div>
  <div><span>Alamat</span>: <?= $pel['ALAMAT'] ?></div>
  <div><span>Accesoris</span>: <?= $bar['AKSESORIS'] ?></div>
  <div><span>Masalah</span>: <?= $bar['MASALAH'] ?></div>
  <div><span>Harga</span>: Rp <?= number_format($bar['ESTIMASI'], 0, ',', '.') ?></div>
  <div><span>Tanggal Masuk</span>: <?= date('d-m-Y H:i', strtotime($bar['TANGGAL'])) ?></div>
  <div><span>Tanggal Selesai</span>: <?= $bar['SELESAI'] == '0000-00-00 00:00:00' ? '-' : date('d-m-Y H:i', strtotime($bar['SELESAI'])) ?></div>
  <div><span>Keterangan</span>: <?= $bar['KETERANGAN'] ?></div>
</div>

<h3 class="garansi">
  GARANSI SERVICE 1 BULAN, JIKA TIDAK DIAMBIL MELEBIHI<br>
  ESTIMASI WAKTU GARANSI, MAKA SECARA OTOMATIS,<br>
  BARANG TIDAK AKAN MENJADI TANGGUNG JAWAB PERUSAHAAN.
</h3>

<div class="ttd">
  <div>
    Teknisi<br><br><br>
    (.................................)
  </div>
  <div>
    Admin<br><br><br>
    (.................................)
  </div>
</div>

<div class="noprint">
  <button onclick="window.print()">Cetak Sekarang</button>
  <button onclick="window.location.href='index.php'">Kembali</button>
</div>

</body>
</html>
