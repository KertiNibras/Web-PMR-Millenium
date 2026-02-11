<?php
session_start();
// Cek apakah user sudah login
if (!isset($_SESSION['nama'])) {
    // Tampilkan Alert JS dulu, baru redirect
    echo '<script type="text/javascript">';
    echo 'alert("Silakan login terlebih dahulu!");';
    echo 'window.location.href = "../Login/login.php";';
    echo '</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Absensi | PMR Millenium</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <!-- Icon -->
  <link rel="icon" href="../Gambar/logpmi.png" type="image/png">
  
  <style>
    /* --- 1. CSS VARIABLES (Sama persis dengan Anggota Dashboard) --- */
    :root {
      --primary-color: #d90429;
      --primary-hover: #c92a2a;
      --bg-color: #f8f9fa;
      --card-bg: #ffffff;
      --text-color: #1e293b;
      --text-muted: #64748b;
      --border-color: #e2e8f0;
      
      /* Status Colors */
      --success-color: #10b981;
      --warning-color: #f59e0b;
      --info-color: #0ea5e9;
      --danger-color: #ef4444;

      --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
      --shadow-md: 0 4px 6px rgba(0,0,0,0.05);
      --radius: 12px;
      --header-height: 70px;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Inter', 'Segoe UI', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      line-height: 1.6;
    }

    a { text-decoration: none; color: inherit; }
    ul { list-style: none; }

    /* --- 2. HEADER --- */
    header {
      background: #fff;
      box-shadow: var(--shadow-sm);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      height: var(--header-height);
    }

    .navbar {
      max-width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 100%;
      padding: 0 20px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 700;
      font-size: 18px;
      color: #000;
    }

    .logo img { height: 40px; }

    .menu-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: var(--primary-color);
    }

    .back-btn {
      display: none;
      background: none;
      border: none;
      font-size: 20px;
      color: var(--primary-color);
      cursor: pointer;
      margin-right: 10px;
    }

    /* --- 3. LAYOUT UTAMA --- */
    .dashboard-container {
      display: flex;
      min-height: 100vh;
      padding-top: var(--header-height);
    }

    /* --- 4. SIDEBAR --- */
    .sidebar {
      width: 250px;
      background: #fff;
      border-right: 1px solid var(--border-color);
      position: sticky;
      top: var(--header-height);
      height: calc(100vh - var(--header-height));
      overflow-y: auto;
      z-index: 900;
    }

    .sidebar li {
      padding: 14px 25px;
      cursor: pointer;
      color: var(--text-color);
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 12px;
      border-left: 4px solid transparent;
      transition: all 0.2s;
    }

    .sidebar li:hover, .sidebar li.active {
      background-color: #fff1f1;
      color: var(--primary-color);
      border-left-color: var(--primary-color);
    }

    .sidebar a { display: flex; align-items: center; gap: 10px; width: 100%; }

    /* --- 5. MAIN CONTENT --- */
    .main-content {
      flex: 1;
      padding: 30px;
    }

    .page-title h1 {
      font-size: 1.75rem;
      color: var(--primary-color);
      margin-bottom: 5px;
    }

    .page-title p {
      color: var(--text-muted);
      font-size: 0.95rem;
      margin-bottom: 25px;
    }

    /* Action Bar */
    .action-bar {
      background: white;
      padding: 20px;
      border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
      margin-bottom: 25px;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      align-items: center;
      justify-content: space-between;
      border: 1px solid var(--border-color);
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s;
      font-size: 0.9rem;
      color: white;
    }

    .btn-primary { background-color: var(--primary-color); }
    .btn-primary:hover { background-color: var(--primary-hover); }

    /* Grouping Filters */
    .filters-wrapper {
      display: flex;
      gap: 15px;
      flex: 1;
      justify-content: flex-end;
    }

    .filter-group {
      min-width: 140px;
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .filter-group label {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--text-muted);
      margin-left: 4px;
    }

    .filter-control {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 0.9rem;
      outline: none;
      cursor: pointer;
    }
    .filter-control:focus { border-color: var(--primary-color); }

    /* --- 6. TABLE --- */
    .table-container {
      background: white;
      border-radius: var(--radius);
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border-color);
      overflow-x: auto;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }

    .data-table th {
      background-color: var(--primary-color);
      color: white;
      text-align: left;
      padding: 15px;
      font-weight: 600;
    }

    .data-table td {
      padding: 15px;
      border-bottom: 1px solid var(--border-color);
      vertical-align: middle;
      color: var(--text-color);
    }

    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover { background-color: #f9fafb; }

    /* Status Badges */
    .status-badge {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      text-align: center;
      min-width: 80px;
    }
    .status-hadir { background-color: #dcfce7; color: var(--success-color); }
    .status-izin { background-color: #fef3c7; color: var(--warning-color); }
    .status-sakit { background-color: #e0f2fe; color: var(--info-color); }
    .status-alpha { background-color: #fee2e2; color: var(--danger-color); }

    /* --- 7. MODAL (Absensi Wajah) --- */
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 2000;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-content {
      background: white;
      border-radius: var(--radius);
      width: 100%;
      max-width: 500px;
      overflow: hidden;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
      padding: 15px 20px;
      background: var(--primary-color);
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h3 { font-size: 1.1rem; }
    .close-modal { background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; }

    .modal-body {
      padding: 20px;
      text-align: center;
    }

    .camera-wrapper {
      width: 100%;
      background: #000;
      border-radius: 8px;
      overflow: hidden;
      margin: 15px 0;
      position: relative;
      aspect-ratio: 4/3;
    }

    #video, #captured-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: scaleX(-1); /* Mirror effect */
    }
    
    #captured-image { display: none; }

    .modal-footer { margin-top: 15px; display: flex; justify-content: center; gap: 10px; }

    /* --- 8. RESPONSIVE --- */
    @media (max-width: 992px) {
      .main-content { width: 100%; padding: 20px; }
      .sidebar {
        position: fixed; top: var(--header-height); left: -260px;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      }
      .sidebar.active { left: 0; }
      .menu-toggle, .back-btn { display: block; }
      
      .action-bar { flex-direction: column; align-items: stretch; gap: 15px; }
      .btn { width: 100%; justify-content: center; }
      .filters-wrapper { flex-direction: column; width: 100%; }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header>
    <nav class="navbar">
      <button class="back-btn" onclick="goBack()"><i class="fa-solid fa-arrow-left"></i></button>
      
      <div class="logo">
        <img src="../Gambar/logpmi.png" alt="Logo">
        <span>PMR MILLENIUM</span>
      </div>

      <button class="menu-toggle"><i class="fa-solid fa-bars"></i></button>
    </nav>
  </header>

  <div class="dashboard-container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
      <ul>
        <li><a href="anggota.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
        <li class="active"><a href="absensi.php"><i class="fa-solid fa-calendar-check"></i> Rekap Absensi</a></li>
        <li><a href="perpus.php"><i class="fa-solid fa-book"></i> Perpustakaan Digital</a></li>
        <!-- LOGOUT: SUDAH DISAMAKAN DENGAN anggota.php -->
        <li style="margin-top: 20px; border-top: 1px solid #eee;">
            <a href="javascript:void(0)" onclick="confirmLogout()">
                <i class="fa-solid fa-right-from-bracket"></i> Log Out
            </a>
        </li>
      </ul>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main-content">
      <div class="page-title">
        <h1>Riwayat Absensi</h1>
        <p>Catat kehadiranmu dan pantau riwayat kegiatan PMR.</p>
      </div>

      <!-- Action Bar -->
      <section class="action-bar">
        <button class="btn btn-primary" id="btnOpenCamera">
          <i class="fa-solid fa-camera"></i> Absensi Wajah
        </button>
        
        <!-- FILTER BARU: Urutkan & Status -->
        <div class="filters-wrapper">
          <div class="filter-group">
            <label>Urutkan Tanggal</label>
            <select id="sortFilter" class="filter-control">
              <option value="newest">Terbaru</option>
              <option value="oldest">Terlama</option>
            </select>
          </div>
          
          <div class="filter-group">
            <label>Status</label>
            <select id="statusFilter" class="filter-control">
              <option value="">Semua Status</option>
              <option value="hadir">Hadir</option>
              <option value="izin">Izin</option>
              <option value="sakit">Sakit</option>
            </select>
          </div>
        </div>
      </section>

      <!-- Table -->
      <section class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Kegiatan</th>
              <th>Jam</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <!-- Data will be populated by JS -->
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <!-- MODAL CAMERA -->
  <div class="modal" id="cameraModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Absensi Wajah</h3>
        <button class="close-modal" id="btnCloseModal">&times;</button>
      </div>
      <div class="modal-body">
        <p style="font-size: 0.9rem; color: #666;">Pastikan wajah terlihat jelas di bingkai.</p>
        
        <div class="camera-wrapper">
          <video id="video" autoplay playsinline></video>
          <canvas id="canvas" style="display:none;"></canvas>
          <img id="capturedImage" alt="Capture Result">
        </div>

        <div id="cameraControls" class="modal-footer">
          <button class="btn btn-primary" id="btnCapture">
            <i class="fa-solid fa-camera"></i> Ambil Foto
          </button>
        </div>

        <div id="successMessage" style="display: none; padding: 10px;">
          <div style="color: var(--success-color); font-size: 3rem; margin-bottom: 10px;">
            <i class="fa-solid fa-check-circle"></i>
          </div>
          <h4>Absensi Berhasil!</h4>
          <button class="btn btn-primary" style="margin-top: 15px;" onclick="closeModalFunc()">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // --- DATA DUMMY ---
    const attendanceData = [
      { id: 1, tanggal: "2023-11-05", kegiatan: "Latihan P3K", jam: "16:00", status: "hadir" },
      { id: 2, tanggal: "2023-11-01", kegiatan: "Rapat Pengurus", jam: "15:00", status: "hadir" },
      { id: 3, tanggal: "2023-10-20", kegiatan: "Simulasi Bencana", jam: "08:00", status: "izin" },
      { id: 4, tanggal: "2023-10-15", kegiatan: "Apel Pagi", jam: "07:00", status: "hadir" },
      { id: 5, tanggal: "2023-10-10", kegiatan: "Pelatihan Jumantik", jam: "13:00", status: "sakit" },
      { id: 6, tanggal: "2023-09-25", kegiatan: "Baksos", jam: "09:00", status: "hadir" }
    ];

    // --- DOM ELEMENTS ---
    const tableBody = document.getElementById('tableBody');
    const modal = document.getElementById('cameraModal');
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const capturedImage = document.getElementById('capturedImage');
    const btnOpenCamera = document.getElementById('btnOpenCamera');
    const btnCloseModal = document.getElementById('btnCloseModal');
    const btnCapture = document.getElementById('btnCapture');
    const cameraControls = document.getElementById('cameraControls');
    const successMessage = document.getElementById('successMessage');

    // Filter Elements
    const sortFilter = document.getElementById('sortFilter');
    const statusFilter = document.getElementById('statusFilter');

    let stream = null;

    // --- INITIALIZATION ---
    document.addEventListener('DOMContentLoaded', () => {
      applyFilters(); // Load data with default filters
      setupEventListeners();
    });

    function setupEventListeners() {
      // Sidebar
      const menuToggle = document.querySelector('.menu-toggle');
      const sidebar = document.querySelector('.sidebar');
      
      menuToggle.addEventListener('click', () => sidebar.classList.toggle('active'));
      
      document.addEventListener('click', (e) => {
        if (window.innerWidth <= 992) {
          if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
            sidebar.classList.remove('active');
          }
        }
      });

      // Modal Events
      btnOpenCamera.addEventListener('click', openModal);
      btnCloseModal.addEventListener('click', closeModalFunc);
      modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModalFunc();
      });
      
      // Capture Event
      btnCapture.addEventListener('click', captureImage);

      // Filter Events (PENTING: Mengubah logika filter)
      sortFilter.addEventListener('change', applyFilters);
      statusFilter.addEventListener('change', applyFilters);
    }

    // --- LOGIKA FILTER & URUTKAN ---
    function applyFilters() {
      let data = [...attendanceData]; // Copy data asli

      // 1. Filter Status
      const statusVal = statusFilter.value;
      if (statusVal !== "") {
        data = data.filter(item => item.status === statusVal);
      }

      // 2. Urutkan Tanggal (Sort)
      const sortVal = sortFilter.value;
      data.sort((a, b) => {
        const dateA = new Date(a.tanggal);
        const dateB = new Date(b.tanggal);
        
        if (sortVal === 'newest') {
          return dateB - dateA; // Besar ke Kecil (Terbaru)
        } else {
          return dateA - dateB; // Kecil ke Besar (Terlama)
        }
      });

      renderTable(data);
    }

    // --- TABLE LOGIC ---
    function renderTable(data) {
      tableBody.innerHTML = '';
      if(data.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding: 30px; color: #999;">Data tidak ditemukan.</td></tr>`;
        return;
      }

      data.forEach(item => {
        const dateObj = new Date(item.tanggal);
        const dateStr = dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        
        const statusClass = `status-${item.status}`; 
        
        const row = `
          <tr>
            <td>${dateStr}</td>
            <td>${item.kegiatan}</td>
            <td>${item.jam}</td>
            <td><span class="status-badge ${statusClass}">${item.status.toUpperCase()}</span></td>
          </tr>
        `;
        tableBody.innerHTML += row;
      });
    }

    // --- CAMERA LOGIC ---
    async function openModal() {
      modal.style.display = 'flex';
      resetModalUI();
      
      try {
        stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } });
        video.srcObject = stream;
      } catch (err) {
        alert("Gagal mengakses kamera: " + err.message);
        closeModalFunc();
      }
    }

    function closeModalFunc() {
      modal.style.display = 'none';
      stopCamera();
    }

    function stopCamera() {
      if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
      }
    }

    function captureImage() {
      const originalText = btnCapture.innerHTML;
      btnCapture.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
      btnCapture.disabled = true;

      const context = canvas.getContext('2d');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      
      context.translate(canvas.width, 0);
      context.scale(-1, 1);
      context.drawImage(video, 0, 0, canvas.width, canvas.height);

      setTimeout(() => {
        capturedImage.src = canvas.toDataURL('image/png');
        video.style.display = 'none';
        capturedImage.style.display = 'block';
        cameraControls.style.display = 'none';
        successMessage.style.display = 'block';
        
        stopCamera();
        
        btnCapture.innerHTML = originalText;
        btnCapture.disabled = false;
      }, 1000);
    }

    function resetModalUI() {
      video.style.display = 'block';
      capturedImage.style.display = 'none';
      capturedImage.src = '';
      cameraControls.style.display = 'flex';
      successMessage.style.display = 'none';
      btnCapture.innerHTML = '<i class="fa-solid fa-camera"></i> Ambil Foto';
      btnCapture.disabled = false;
    }

    function goBack() {
      window.history.back();
    }
    // TAMBAHKAN FUNGSI INI:
  function confirmLogout() {
    // Tampilkan pesan konfirmasi
    if (confirm("Apakah Anda yakin ingin keluar dari akun?")) {
      // Jika user klik 'OK', lempar ke halaman logout
      window.location.href = "../logout.php";
    }
    // Jika 'Cancel', tidak terjadi apa-apa
  }
  </script>
</body>
</html>