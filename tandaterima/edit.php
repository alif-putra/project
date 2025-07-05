<?php
include 'koneksi.php';

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}
$id = $_GET['id'];

// Ambil data dari database
$sql = "SELECT barangterima.*, pelanggan.NAMA, pelanggan.ALAMAT, pelanggan.TELEPON1, pelanggan.TELEPON2 
        FROM barangterima 
        JOIN pelanggan ON barangterima.ID = pelanggan.ID
        WHERE barangterima.IDTERIMA = $id";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Proses update jika form disubmit
if (isset($_POST['update'])) {
    $jenisBarang = mysqli_real_escape_string($conn, $_POST['jenisbarang']);
    $masalah     = mysqli_real_escape_string($conn, $_POST['masalah']);
    $estimasi    = mysqli_real_escape_string($conn, $_POST['estimasi']);
    $tanggal     = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $selesai     = mysqli_real_escape_string($conn, $_POST['selesai']);

    // Update data barang
    $updateBarang = "UPDATE barangterima SET 
        JENISBARANG = '$jenisBarang',
        MASALAH = '$masalah',
        ESTIMASI = '$estimasi',
        TANGGAL = '$tanggal',
        SELESAI = '$selesai'
        WHERE IDTERIMA = $id";

    if ($conn->query($updateBarang) === TRUE) {
        // Redirect ke index dengan pesan sukses
        echo "<script>
            alert('Data berhasil diperbarui!');
            window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal memperbarui data: " . $conn->error . "');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Servis - Service Management</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .nav-bar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
            overflow: hidden;
        }
        .nav-link {
            color: #4facfe !important;
            font-weight: 500;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 8px;
            margin: 0.25rem;
        }
        .nav-link:hover {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white !important;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        .breadcrumb {
            color: #666;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin: 2rem auto;
            max-width: 900px;
        }
        .header-section {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px 15px 0 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        .form-section {
            padding: 2.5rem;
        }
        .section-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e3f2fd;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 500;
            color: #34495e;
            margin-bottom: 0.5rem;
            display: block;
        }
        .form-input, .form-select {
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            background: white;
        }
        .form-input:focus, .form-select:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            outline: none;
        }
        .form-input:disabled {
            background: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }
        .readonly-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            border: 1px solid #dee2e6;
        }
        .readonly-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            padding: 0.5rem;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .readonly-item:last-child {
            margin-bottom: 0;
        }
        .readonly-icon {
            color: #6c757d;
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }
        .readonly-content {
            flex: 1;
        }
        .readonly-label {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        .readonly-value {
            font-size: 1rem;
            color: #2c3e50;
            font-weight: 500;
        }
        .editable-section {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid #e3f2fd;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .input-group {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 1;
        }
        .input-with-icon {
            padding-left: 2.5rem;
        }
        .select-with-icon {
            padding-left: 2.5rem;
        }
        .btn-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary:hover {
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.3);
        }
        .btn-secondary {
            background: #6c757d;
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }
        .currency-input {
            position: relative;
        }
        .currency-symbol {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #28a745;
            font-weight: 600;
            z-index: 1;
        }
        .currency-field {
            padding-left: 2.5rem;
        }
        @media (max-width: 768px) {
            .main-container {
                margin: 1rem;
                border-radius: 10px;
            }
            .header-section {
                padding: 1.5rem;
                border-radius: 10px 10px 0 0;
            }
            .form-section {
                padding: 1.5rem;
            }
            .btn-group {
                flex-direction: column;
                align-items: center;
            }
            .btn-primary, .btn-secondary {
                width: 100%;
                justify-content: center;
                max-width: 300px;
            }
            .readonly-item {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }
            .readonly-icon {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="w3-container">
        <!-- Navigation Bar -->
        <div class="nav-bar w3-margin-top">
            <div class="w3-row">
                <div class="w3-col s6 m4 l3">
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </div>
                <div class="w3-col s6 m8 l9">
                    <div class="breadcrumb w3-right-align">
                        <i class="fas fa-edit"></i> Edit Data Servis
                    </div>
                </div>
            </div>
        </div>

        <div class="main-container">
            <!-- Header Section -->
            <div class="header-section">
                <div class="header-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <h1 class="w3-margin-0">Edit Data Servis</h1>
                <p class="w3-margin-0 w3-opacity">Sistem Manajemen Servis Elektronik</p>
            </div>

            <!-- Form Section -->
            <div class="form-section">
                <form method="post">
                    <!-- Customer Information Section -->
                    <div class="section-title">
                        <i class="fas fa-user"></i>
                        <span>Informasi Pelanggan</span>
                    </div>
                    
                    <div class="readonly-section">
                        <div class="readonly-item">
                            <div class="readonly-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="readonly-content">
                                <div class="readonly-label">Nama Pelanggan</div>
                                <div class="readonly-value"><?= htmlspecialchars($data['NAMA']) ?></div>
                            </div>
                        </div>
                        
                        <div class="readonly-item">
                            <div class="readonly-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="readonly-content">
                                <div class="readonly-label">Alamat</div>
                                <div class="readonly-value"><?= htmlspecialchars($data['ALAMAT']) ?></div>
                            </div>
                        </div>
                        
                        <div class="readonly-item">
                            <div class="readonly-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="readonly-content">
                                <div class="readonly-label">Telepon</div>
                                <div class="readonly-value"><?= htmlspecialchars($data['TELEPON1'] . ' / ' . $data['TELEPON2']) ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Information Section -->
                    <div class="section-title">
                        <i class="fas fa-cogs"></i>
                        <span>Informasi Servis</span>
                    </div>
                    
                    <div class="editable-section">
                        <div class="w3-row-padding">
                            <div class="w3-col l6 m6 s12">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-laptop"></i> Jenis Barang
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-laptop input-icon"></i>
                                        <select name="jenisbarang" class="form-select select-with-icon">
                                            <option value="">Pilih Jenis Barang</option>
                                            <option value="Laptop" <?= ($data['JENISBARANG'] == 'Laptop') ? 'selected' : '' ?>>Laptop</option>
                                            <option value="Komputer PC" <?= ($data['JENISBARANG'] == 'Komputer PC') ? 'selected' : '' ?>>Komputer PC</option>
                                            <option value="Smartphone" <?= ($data['JENISBARANG'] == 'Smartphone') ? 'selected' : '' ?>>Smartphone</option>
                                            <option value="Tablet" <?= ($data['JENISBARANG'] == 'Tablet') ? 'selected' : '' ?>>Tablet</option>
                                            <option value="Printer" <?= ($data['JENISBARANG'] == 'Printer') ? 'selected' : '' ?>>Printer</option>
                                            <option value="Monitor" <?= ($data['JENISBARANG'] == 'Monitor') ? 'selected' : '' ?>>Monitor</option>
                                            <option value="Keyboard" <?= ($data['JENISBARANG'] == 'Keyboard') ? 'selected' : '' ?>>Keyboard</option>
                                            <option value="Mouse" <?= ($data['JENISBARANG'] == 'Mouse') ? 'selected' : '' ?>>Mouse</option>
                                            <option value="Headset" <?= ($data['JENISBARANG'] == 'Headset') ? 'selected' : '' ?>>Headset</option>
                                            <option value="Speaker" <?= ($data['JENISBARANG'] == 'Speaker') ? 'selected' : '' ?>>Speaker</option>
                                            <option value="Webcam" <?= ($data['JENISBARANG'] == 'Webcam') ? 'selected' : '' ?>>Webcam</option>
                                            <option value="Hard Disk" <?= ($data['JENISBARANG'] == 'Hard Disk') ? 'selected' : '' ?>>Hard Disk</option>
                                            <option value="SSD" <?= ($data['JENISBARANG'] == 'SSD') ? 'selected' : '' ?>>SSD</option>
                                            <option value="RAM" <?= ($data['JENISBARANG'] == 'RAM') ? 'selected' : '' ?>>RAM</option>
                                            <option value="Motherboard" <?= ($data['JENISBARANG'] == 'Motherboard') ? 'selected' : '' ?>>Motherboard</option>
                                            <option value="Power Supply" <?= ($data['JENISBARANG'] == 'Power Supply') ? 'selected' : '' ?>>Power Supply</option>
                                            <option value="VGA Card" <?= ($data['JENISBARANG'] == 'VGA Card') ? 'selected' : '' ?>>VGA Card</option>
                                            <option value="Processor" <?= ($data['JENISBARANG'] == 'Processor') ? 'selected' : '' ?>>Processor</option>
                                            <option value="Lainnya" <?= ($data['JENISBARANG'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
                                            <?php
                                            // Jika data existing tidak ada dalam pilihan dropdown, tampilkan sebagai option selected
                                            $existingOptions = ['Laptop', 'Komputer PC', 'Smartphone', 'Tablet', 'Printer', 'Monitor', 'Keyboard', 'Mouse', 'Headset', 'Speaker', 'Webcam', 'Hard Disk', 'SSD', 'RAM', 'Motherboard', 'Power Supply', 'VGA Card', 'Processor', 'Lainnya'];
                                            if (!in_array($data['JENISBARANG'], $existingOptions) && !empty($data['JENISBARANG'])) {
                                                echo '<option value="' . htmlspecialchars($data['JENISBARANG']) . '" selected>' . htmlspecialchars($data['JENISBARANG']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w3-col l6 m6 s12">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-exclamation-triangle"></i> Masalah
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-exclamation-triangle input-icon"></i>
                                        <input type="text" name="masalah" class="form-input input-with-icon" 
                                               value="<?= htmlspecialchars($data['MASALAH']) ?>" 
                                               placeholder="Contoh: Tidak bisa nyala">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w3-row-padding">
                            <div class="w3-col l6 m6 s12">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-money-bill-wave"></i> Estimasi Biaya
                                    </label>
                                    <div class="currency-input">
                                        <span class="currency-symbol">Rp</span>
                                        <input type="number" name="estimasi" class="form-input currency-field" 
                                               value="<?= htmlspecialchars($data['ESTIMASI']) ?>" 
                                               placeholder="250000">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w3-col l6 m6 s12">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-plus"></i> Tanggal Masuk
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-calendar-plus input-icon"></i>
                                        <input type="datetime-local" name="tanggal" class="form-input input-with-icon" 
                                               value="<?= date('Y-m-d\TH:i', strtotime($data['TANGGAL'])) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w3-row-padding">
                            <div class="w3-col l6 m6 s12">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-check"></i> Tanggal Selesai
                                    </label>
                                    <div class="input-group">
                                        <i class="fas fa-calendar-check input-icon"></i>
                                        <input type="datetime-local" name="selesai" class="form-input input-with-icon" 
                                               value="<?= date('Y-m-d\TH:i', strtotime($data['SELESAI'])) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="btn-group">
                        <button type="submit" name="update" class="btn-primary">
                            <i class="fas fa-save"></i>
                            Update Data
                        </button>
                        <a href="index.php" class="btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Format currency input
        document.querySelector('input[name="estimasi"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            if (value) {
                // Add thousand separators for display (optional)
                e.target.setAttribute('placeholder', 'Contoh: 250000');
            }
        });
    </script>
</body>
</html>