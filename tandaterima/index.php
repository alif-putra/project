<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Barang Servis</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: white;
      min-height: 100vh;
    }

    .main-container {
      width: 100%;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .header-section {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      color: white;
      padding: 20px;
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
      font-size: 1.8em;
      font-weight: 700;
      margin-bottom: 5px;
      text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .header-subtitle {
      font-size: 0.9em;
      opacity: 0.9;
    }

    .action-bar {
      padding: 20px;
      background: #f8f9fa;
      border-bottom: 1px solid #e9ecef;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
    }

    .search-container {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
      min-width: 300px;
    }

    .search-input {
      flex: 1;
      padding: 12px 20px;
      border: 2px solid #e9ecef;
      border-radius: 25px;
      font-size: 16px;
      transition: all 0.3s ease;
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .search-input:focus {
      outline: none;
      border-color: #4facfe;
      box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
    }

    .search-btn {
      padding: 12px 20px;
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      color: white;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .search-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .btn-custom {
      border-radius: 25px;
      padding: 12px 25px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .btn-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .table-container {
      flex: 1;
      padding: 0;
      overflow-x: auto;
    }

    .w3-table-all {
      width: 100%;
      border-collapse: collapse;
      margin: 0;
    }

    .table-header {
      background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
      color: white;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table-row {
      transition: all 0.3s ease;
      border-bottom: 1px solid #e9ecef;
    }

    .table-row:hover {
      background-color: #f8f9fa;
    }

    .w3-table-all td, .w3-table-all th {
      padding: 12px;
      text-align: left;
      vertical-align: middle;
    }

    .action-buttons {
      display: flex;
      gap: 5px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .btn-action {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85em;
      font-weight: 500;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      min-width: 70px;
      justify-content: center;
    }

    .btn-action:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .status-badge {
      padding: 4px 12px;
      border-radius: 15px;
      font-size: 0.8em;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .clickable-name {
      cursor: pointer;
      transition: all 0.3s ease;
      padding: 5px 10px;
      border-radius: 8px;
      text-decoration: none;
      color: inherit;
      display: inline-block;
    }

    .clickable-name:hover {
      background-color: #e3f2fd;
      color: #1976d2;
      transform: translateX(5px);
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #6c757d;
    }

    .empty-state i {
      font-size: 4em;
      margin-bottom: 20px;
      opacity: 0.5;
    }

    /* Floating Add Button */
    .floating-add-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 1000;
    }

    .fab {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
      color: white;
      border-radius: 50%;
      text-decoration: none;
      font-size: 1.5em;
      box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
      animation: float-btn 3s ease-in-out infinite;
    }

    .fab:hover {
      transform: scale(1.1) translateY(-5px);
      box-shadow: 0 15px 35px rgba(40, 167, 69, 0.6);
      background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
    }

    .fab:active {
      transform: scale(0.95);
    }

    @keyframes float-btn {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-10px) rotate(180deg); }
    }

    .fab i {
      transition: transform 0.3s ease;
    }

    .fab:hover i {
      transform: rotate(90deg);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .header-title {
        font-size: 1.5em;
      }
      
      .header-subtitle {
        font-size: 0.8em;
      }
      
      .header-section {
        padding: 15px;
      }
      
      .action-bar {
        padding: 15px;
      }
      
      .search-container {
        min-width: auto;
      }
      
      .action-buttons {
        flex-direction: column;
        gap: 3px;
      }
      
      .btn-action {
        width: 100%;
        min-width: auto;
      }

      .floating-add-btn {
        bottom: 20px;
        right: 20px;
      }

      .fab {
        width: 55px;
        height: 55px;
        font-size: 1.3em;
      }
    }

    @media (max-width: 480px) {
      .header-title {
        font-size: 1.3em;
      }
      
      .header-subtitle {
        font-size: 0.75em;
      }
      
      .header-section {
        padding: 12px;
      }
      
      .btn-custom {
        padding: 10px 20px;
        font-size: 0.9em;
      }
      
      .w3-table-all {
        font-size: 0.85em;
      }
      
      .search-input {
        font-size: 14px;
      }

      .floating-add-btn {
        bottom: 15px;
        right: 15px;
      }

      .fab {
        width: 50px;
        height: 50px;
        font-size: 1.2em;
      }
    }
  </style>
</head>
<body>
  <div class="main-container">
    
    <!-- Header Section -->
    <div class="header-section">
      <h1 class="header-title">
        <i class="fas fa-clipboard-list"></i>
        Daftar Barang Servis
      </h1>
    </div>

    <!-- Action Bar -->
    <div class="action-bar">
      <div class="search-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Cari nama pelanggan..." onkeyup="searchTable()">
        <button class="search-btn" onclick="clearSearch()">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
      <div class="w3-responsive">
        <table class="w3-table-all w3-hoverable" id="dataTable">
          <thead>
            <tr class="table-header">
              <th class="w3-center">No</th>
              <th>Nama Pelanggan</th>
              <th class="w3-hide-small">Alamat</th>
              <th>Telepon</th>
              <th>Jenis Barang</th>
              <th class="w3-hide-small">Masalah</th>
              <th>Estimasi Biaya</th>
              <th class="w3-hide-small">Tanggal Masuk</th>
              <th class="w3-center">Aksi</th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <?php
            $sql = "SELECT barangterima.*, 
                           pelanggan.NAMA, 
                           pelanggan.ALAMAT, 
                           pelanggan.TELEPON1, 
                           pelanggan.TELEPON2, 
                           pelanggan.ID AS ID_PELANGGAN
                    FROM barangterima
                    JOIN pelanggan ON barangterima.ID = pelanggan.ID
                    WHERE barangterima.VOID = 0
                    ORDER BY barangterima.IDTERIMA DESC";

            $result = $conn->query($sql);
            
            // Hitung total data untuk nomor urut terbalik
            $totalData = $result->num_rows;
            $no = $totalData;

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $tanggalMasuk = date('d/m/Y', strtotime($row['TANGGAL']));
                    $estimasi = number_format($row['ESTIMASI'], 0, ",", ".");
                    
                    // Warna untuk jenis barang yang berbeda-beda
                    $jenisBarang = strtolower(trim($row['JENISBARANG']));
                    $deviceColorClass = 'w3-grey';
                    
                    if (stripos($jenisBarang, 'pc') !== false) {
                        $deviceColorClass = 'w3-red';
                    } elseif (stripos($jenisBarang, 'laptop') !== false) {
                        $deviceColorClass = 'w3-blue';
                    } elseif (stripos($jenisBarang, 'tv') !== false) {
                        $deviceColorClass = 'w3-orange';
                    } elseif (stripos($jenisBarang, 'cctv') !== false) {
                        $deviceColorClass = 'w3-purple';
                    } elseif (stripos($jenisBarang, 'monitor') !== false) {
                        $deviceColorClass = 'w3-teal';
                    } elseif (stripos($jenisBarang, 'router') !== false) {
                        $deviceColorClass = 'w3-brown';
                    } elseif (stripos($jenisBarang, 'printer') !== false) {
                        $deviceColorClass = 'w3-green';
                    } elseif (stripos($jenisBarang, 'handphone') !== false || stripos($jenisBarang, 'hp') !== false) {
                        $deviceColorClass = 'w3-pink';
                    } elseif (stripos($jenisBarang, 'tablet') !== false) {
                        $deviceColorClass = 'w3-cyan';
                    } elseif (stripos($jenisBarang, 'ups') !== false) {
                        $deviceColorClass = 'w3-deep-orange';
                    } elseif (stripos($jenisBarang, 'harddisk') !== false || stripos($jenisBarang, 'hdd') !== false) {
                        $deviceColorClass = 'w3-indigo';
                    } elseif (stripos($jenisBarang, 'keyboard') !== false) {
                        $deviceColorClass = 'w3-lime';
                    } elseif (stripos($jenisBarang, 'mouse') !== false) {
                        $deviceColorClass = 'w3-amber';
                    } elseif (stripos($jenisBarang, 'speaker') !== false) {
                        $deviceColorClass = 'w3-deep-purple';
                    } else {
                        // Jika tidak ada yang cocok, buat warna berdasarkan hash nama
                        $hash = crc32($jenisBarang);
                        $colors = ['w3-khaki', 'w3-sand', 'w3-light-green', 'w3-light-blue', 'w3-pale-yellow', 'w3-pale-red', 'w3-pale-green', 'w3-light-grey'];
                        $deviceColorClass = $colors[abs($hash) % count($colors)];
                    }
                    
                    echo "<tr class='table-row'>
                        <td class='w3-center'><span class='status-badge w3-blue'>".$no--."</span></td>
                        <td>
                          <a href='tambah.php?nama=".urlencode($row['NAMA'])."' class='clickable-name'>
                            <div class='w3-text-dark-grey'><strong>".htmlspecialchars($row['NAMA'])."</strong></div>
                          </a>
                          <div class='w3-text-grey w3-small w3-hide-large'>".htmlspecialchars($row['ALAMAT'])."</div>
                        </td>
                        <td class='w3-hide-small w3-text-grey'>".htmlspecialchars($row['ALAMAT'])."</td>
                        <td>
                          <div class='w3-text-dark-grey'>".htmlspecialchars($row['TELEPON1'])."</div>
                          <div class='w3-text-grey w3-small'>".htmlspecialchars($row['TELEPON2'])."</div>
                        </td>
                        <td>
                          <span class='status-badge ".$deviceColorClass."'>".htmlspecialchars($row['JENISBARANG'])."</span>
                          <div class='w3-text-grey w3-small w3-hide-large'>".htmlspecialchars($row['MASALAH'])."</div>
                        </td>
                        <td class='w3-hide-small w3-text-grey'>".htmlspecialchars($row['MASALAH'])."</td>
                        <td>
                          <div class='w3-text-green'><strong>Rp ".$estimasi."</strong></div>
                        </td>
                        <td class='w3-hide-small w3-text-grey'>".$tanggalMasuk."</td>
                        <td class='w3-center'>
                          <div class='action-buttons'>
                            <a href='edit.php?id=".$row['IDTERIMA']."' class='btn-action w3-orange w3-hover-deep-orange' title='Edit Data'>
                              <i class='fas fa-edit'></i>
                              <span class='w3-hide-small'>Edit</span>
                            </a>
                            <a href='hapus.php?id=".$row['IDTERIMA']."' class='btn-action w3-red w3-hover-deep-red' 
                               onclick=\"return confirm('Yakin ingin menghapus data ini?')\" title='Hapus Data'>
                              <i class='fas fa-trash'></i>
                              <span class='w3-hide-small'>Hapus</span>
                            </a>
                            <a href='cetak.php?idpel=".$row['ID_PELANGGAN']."' class='btn-action w3-blue w3-hover-blue' title='Cetak Data'>
                              <i class='fas fa-print'></i>
                              <span class='w3-hide-small'>Cetak</span>
                            </a>
                          </div>
                        </td>
                      </tr>";
                }
            } else {
                echo "<tr id='noDataRow'>
                        <td colspan='9' class='empty-state'>
                          <i class='fas fa-inbox'></i>
                          <h3>Belum Ada Data</h3>
                          <p>Silakan tambahkan data barang servis baru</p>
                        </td>
                      </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Floating Add Button -->
  <div class="floating-add-btn">
    <a href="tambah.php" class="fab" title="Tambah Data Baru">
      <i class="fas fa-plus"></i>
    </a>
  </div>

  <script>
    // Search functionality
    function searchTable() {
      const input = document.getElementById('searchInput');
      const filter = input.value.toLowerCase();
      const table = document.getElementById('dataTable');
      const rows = table.getElementsByTagName('tr');
      let hasVisibleRows = false;
      
      for (let i = 1; i < rows.length; i++) {
        const nameCell = rows[i].getElementsByTagName('td')[1];
        if (nameCell) {
          const nameText = nameCell.textContent || nameCell.innerText;
          if (nameText.toLowerCase().indexOf(filter) > -1) {
            rows[i].style.display = '';
            hasVisibleRows = true;
          } else {
            rows[i].style.display = 'none';
          }
        }
      }
      
      // Show/hide no results message
      const noDataRow = document.getElementById('noDataRow');
      if (noDataRow) {
        noDataRow.style.display = hasVisibleRows ? 'none' : '';
      }
    }

    // Clear search
    function clearSearch() {
      document.getElementById('searchInput').value = '';
      searchTable();
    }

    // Add loading animation
    document.addEventListener('DOMContentLoaded', function() {
      const rows = document.querySelectorAll('.table-row');
      rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        setTimeout(() => {
          row.style.transition = 'all 0.5s ease';
          row.style.opacity = '1';
          row.style.transform = 'translateY(0)';
        }, index * 50);
      });
    });

    // Add ripple effect to buttons
    document.querySelectorAll('.btn-action').forEach(button => {
      button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = e.clientX - rect.left - size / 2 + 'px';
        ripple.style.top = e.clientY - rect.top - size / 2 + 'px';
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255,255,255,0.5)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s linear';
        ripple.style.pointerEvents = 'none';
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        
        setTimeout(() => {
          ripple.remove();
        }, 600);
      });
    });

    // Add enter key support for search
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        searchTable();
      }
    });
  </script>

  <style>
    @keyframes ripple {
      to {
        transform: scale(4);
        opacity: 0;
      }
    }
  </style>
</body>
</html>`