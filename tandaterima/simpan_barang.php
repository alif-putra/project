<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID pelanggan tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis     = $_POST['jenisbarang'];
    $masalah   = $_POST['masalah'];
    $ket       = $_POST['keterangan'];
    $tanggal   = $_POST['tanggal'];
    $selesai   = $_POST['selesai'] ?: '0000-00-00 00:00:00';
    $aksesoris = $_POST['aksesoris'];
    $estimasi  = $_POST['estimasi'];
    $now       = date('Y-m-d H:i:s');
    $user      = 'admin';

    $sql = "INSERT INTO barangterima (
                JENISBARANG, MASALAH, KETERANGAN, TANGGAL, SELESAI,
                AKSESORIS, ESTIMASI, USERRECORD, USERMODIFIED,
                DATERECORD, DATEMODIFIED, VOID, ID
            ) VALUES (
                '$jenis', '$masalah', '$ket', '$tanggal', '$selesai',
                '$aksesoris', '$estimasi', '$user', '$user',
                '$now', '$now', 0, '$id'
            )";

    if (mysqli_query($conn, $sql)) {
        header("Location: cetak.php?idpel=$id");
        exit;
    } else {
        echo "<div class='w3-container w3-red w3-margin'>Gagal menyimpan data barang: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang Masuk</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin: 20px auto;
            max-width: 800px;
            animation: slideIn 0.6s ease-out;
            overflow: hidden;
            position: relative;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header-section {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .header-title {
            font-size: 2.2em;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
        }

        .header-subtitle {
            font-size: 1.1em;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .form-container {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1em;
        }

        .form-label i {
            margin-right: 8px;
            color: #4facfe;
            width: 20px;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            transform: translateY(-2px);
        }

        .form-input:hover {
            border-color: #4facfe;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-col {
            flex: 1;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-width: 150px;
            justify-content: center;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
        }

        .currency-input {
            padding-left: 50px;
        }

        .currency-symbol {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #28a745;
            font-weight: 600;
        }

        .form-note {
            font-size: 0.9em;
            color: #6c757d;
            margin-top: 5px;
            font-style: italic;
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #4facfe;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .header-section {
                padding: 20px;
            }
            
            .header-title {
                font-size: 1.8em;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .button-group {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-custom {
                width: 100%;
                max-width: 300px;
            }
        }

        @media (max-width: 480px) {
            .header-title {
                font-size: 1.5em;
            }
            
            .form-input {
                padding: 12px 15px;
            }
            
            .btn-custom {
                padding: 12px 25px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="w3-container w3-padding">
        <div class="main-container">
            
            <!-- Header Section -->
            <div class="header-section">
                <h1 class="header-title">
                    Form Input Barang Masuk
                </h1>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <form method="POST" id="barangForm">
                                
                    <div class="form-group">
                        <label class="form-label">
                            Jenis Barang
                        </label>
                        <select name="jenisbarang" class="form-input" required>
                            <option value="">Pilih Jenis Barang</option>
                            <option value="Laptop">Laptop</option>
                            <option value="PC">PC</option>
                            <option value="TV">TV</option>
                            <option value="CCTV">CCTV</option>
                          
                        </select>
                    </div>



                    <div class="form-group">
                        <label class="form-label">
                            Masalah
                        </label>
                        <input type="text" name="masalah" class="form-input" required 
                               placeholder="Jelaskan masalah yang dialami">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Keterangan Detail
                        </label>
                        <textarea name="keterangan" class="form-input form-textarea" required 
                                  placeholder="Berikan keterangan lengkap tentang kondisi barang dan masalah yang dialami"></textarea>
                    </div>

                    
                    <div class="form-group">
                        <label class="form-label">
                            Aksesoris
                        </label>
                        <select name="aksesoris" class="form-input" required>
                            <option value="">Pilih Aksesoris</option>
                            <option value="tas">Tas</option>
                            <option value="charger">Charger</option>
                            <option value="kabeldata">Kabel Data</option>
                        
                        </select>
                     </div>

                     <div class="form-group">
                        <label class="form-label">
                            Estimasi Biaya
                        </label>
                    </div>
                    <div class="input-group w3-responsive">
                        <input type="text" name="estimasi" class="form-input currency-input"  placeholder="Rp.contoh 1000" required></div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">
                                    Tanggal Masuk
                                </label>
                                <input type="datetime-local" name="tanggal" class="form-input" 
                                       value="<?= date('d-m-Y\TH:i') ?>" required>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">
                                    Tanggal Selesai (Opsional)
                                </label>
                                <input type="datetime-local" name="selesai" class="form-input">
                                <div class="form-note">Kosongkan jika belum selesai</div>
                            </div>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-custom btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan & Cetak
                        </button>
                        <a href="index.php" class="btn-custom btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        // Prevent auto-scroll on page load
        if (history.scrollRestoration) {
            history.scrollRestoration = 'manual';
        }
        
        // Format currency input
        document.querySelector('input[name="estimasi"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            e.target.value = value;
        });

        // Form submission with loading
        document.getElementById('barangForm').addEventListener('submit', function(e) {
            document.getElementById('loadingOverlay').style.display = 'flex';
        });

        // Form validation enhancement
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.style.borderColor = '#dc3545';
                    this.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
                } else {
                    this.style.borderColor = '#28a745';
                    this.style.boxShadow = '0 0 0 3px rgba(40, 167, 69, 0.1)';
                }
            });

            input.addEventListener('focus', function() {
                this.style.borderColor = '#4facfe';
                this.style.boxShadow = '0 0 0 3px rgba(79, 172, 254, 0.1)';
            });
        });

        // Add form animation on load
        document.addEventListener('DOMContentLoaded', function() {
            // Force scroll to top and prevent automatic scrolling
            setTimeout(() => {
                window.scrollTo(0, 0);
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }, 100);
            
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    group.style.transition = 'all 0.5s ease';
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
    
</body>
</html>