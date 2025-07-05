<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Tanda Terima - Service Management</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header-section {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        
        .header-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        
        .header-title {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
        }
        
        .header-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0.5rem 0 0 0;
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
            font-size: 1.2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #34495e;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.95rem;
        }
        
        .form-input {
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            font-family: inherit;
        }
        
        .form-input:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            outline: none;
        }
        
        .form-select {
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            font-family: inherit;
            background: white;
            cursor: pointer;
        }
        
        .form-select:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            outline: none;
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
        
        .form-grid {
            display: grid;
            gap: 1.5rem;
        }
        
        .form-grid-2 {
            grid-template-columns: 1fr 1fr;
        }
        
        .btn-container {
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
            padding: 0.875rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            font-family: inherit;
        }
        
        .btn-primary:hover {
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
        }
        
        .btn-secondary {
            background: #6c757d;
            border: none;
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            font-family: inherit;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }
        
        .required-indicator {
            color: #e74c3c;
            font-weight: 600;
        }
        
        .form-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            border: 1px solid #e3f2fd;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .main-container {
                margin: 0;
                border-radius: 10px;
            }
            
            .header-section {
                padding: 1.5rem;
            }
            
            .header-title {
                font-size: 1.5rem;
            }
            
            .form-section {
                padding: 1.5rem;
            }
            
            .form-grid-2 {
                grid-template-columns: 1fr;
            }
            
            .btn-container {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-primary, .btn-secondary {
                width: 100%;
                justify-content: center;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1 class="header-title">Form Tanda Terima</h1>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <form action="simpan_pelanggan.php" method="POST">
                <div class="form-card">
                    <!-- Section Title -->
                    <div class="section-title">
                        <i class="fas fa-user"></i>
                        <span>Data Pelanggan</span>
                    </div>
                    
                    <!-- Form Fields -->
                    <div class="form-grid">
                        <!-- Nama -->
                        <div class="form-group">
                            <label class="form-label">
                                 Nama Lengkap <span class="required-indicator">*</span>
                            </label>
                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" name="nama" class="form-input input-with-icon" 
                                       placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="form-group">
                            <label class="form-label">
                                 Alamat <span class="required-indicator">*</span>
                            </label>
                            <div class="input-group">
                                <i class="fas fa-map-marker-alt input-icon"></i>
                                <input type="text" name="alamat" class="form-input input-with-icon" 
                                       placeholder="Masukkan alamat lengkap" required>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="form-group">
                            <label class="form-label">
                                 Jenis Kelamin <span class="required-indicator">*</span>
                            </label>
                            <select name="jk" class="form-select" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <!-- Telepon Grid -->
                        <div class="form-grid form-grid-2">
                            <div class="form-group">
                                <label class="form-label">
                                     Telepon <span class="required-indicator">*</span>
                                </label>
                                <div class="input-group">
                                    <i class="fas fa-phone input-icon"></i>
                                    <input type="tel" name="telp1" class="form-input input-with-icon" 
                                           placeholder="Contoh: 081234567890" required>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label class="form-label">
                                 Email <span class="required-indicator">*</span>
                            </label>
                            <div class="input-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" name="email" class="form-input input-with-icon" 
                                       placeholder="Contoh: nama@email.com" required>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="btn-container">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan & Lanjut
                        </button>
                        <a href="index.php" class="btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Format phone number input
        document.querySelectorAll('input[type="tel"]').forEach(function(input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 15) {
                    value = value.slice(0, 15);
                }
                e.target.value = value;
            });
        });

        // Email validation
        document.querySelector('input[type="email"]').addEventListener('blur', function(e) {
            const email = e.target.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                e.target.style.borderColor = '#e74c3c';
            } else {
                e.target.style.borderColor = '#e1e8ed';
            }
        });
    </script>
</body>
</html>