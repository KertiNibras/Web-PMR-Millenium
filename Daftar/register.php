<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota | PMR Millenium</title>
    
    <!-- Google Fonts Inter (Sama dengan Login/Dashboard) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- CSS VARIABLES (Sama Persis dengan Login & Dashboard) --- */
        :root {
            --primary-color: #e23838; /* Merah PMR */
            --primary-hover: #c92a2a;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --radius: 16px;
            --shadow: 0 10px 25px rgba(0,0,0,0.05);
            --input-radius: 10px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* --- CONTAINER UTAMA --- */
        .reg-card {
            background-color: var(--card-bg);
            width: 100%;
            max-width: 600px; /* Sedikit lebih lebar dari login */
            padding: 40px 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            text-align: center;
            position: relative;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- LOGO --- */
        .logo {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }
        .logo img { width: 70px; height: 70px; }

        /* --- TYPOGRAPHY --- */
        h2 { font-size: 1.5rem; margin-bottom: 8px; font-weight: 700; color: var(--text-main); }
        .subtitle { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 30px; }

        /* --- FORM ELEMENTS --- */
        .form-group { margin-bottom: 20px; text-align: left; }
        
        label { 
            display: block; 
            font-size: 0.85rem; 
            font-weight: 600; 
            color: var(--text-main); 
            margin-bottom: 8px; 
            margin-left: 2px; 
        }

        .required { color: var(--primary-color); }

        /* Input Grid Layout */
        .row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        @media (max-width: 500px) { .row-2 { grid-template-columns: 1fr; } }

        input, select, textarea {
            width: 100%; 
            padding: 12px 14px;
            border: 1px solid var(--border-color); 
            border-radius: var(--input-radius);
            font-size: 0.95rem; 
            color: var(--text-main);
            background-color: #fff;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        input:focus, select:focus, textarea:focus { 
            border-color: var(--primary-color); 
            outline: none; 
            box-shadow: 0 0 0 3px rgba(226, 56, 56, 0.1); 
        }

        textarea { resize: vertical; min-height: 100px; }

        /* --- DYNAMIC ACHIEVEMENT --- */
        .achievement-wrapper { margin-bottom: 15px; }
        .achievement-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }
        
        .btn-remove {
            background-color: #fee2e2;
            color: #dc2626;
            border: none;
            width: 42px; height: 42px;
            border-radius: var(--input-radius);
            cursor: pointer;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
            flex-shrink: 0;
        }
        .btn-remove:hover { background-color: #fecaca; }

        .btn-add {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px dashed var(--primary-color);
            padding: 8px 12px;
            border-radius: var(--input-radius);
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: 100%;
            justify-content: center;
        }
        .btn-add:hover { background-color: #fff1f1; }

        /* --- BUTTONS --- */
        .btn-submit {
            display: block; 
            width: 100%; 
            padding: 14px;
            border-radius: var(--input-radius); 
            font-weight: 600; 
            font-size: 1rem;
            text-decoration: none; 
            border: none; 
            cursor: pointer;
            transition: all 0.2s ease; 
            color: #fff;
            background-color: var(--primary-color);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 10px;
        }
        .btn-submit:hover { 
            background-color: var(--primary-hover); 
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0,0,0,0.15);
        }

        /* Tombol Kembali */
        .btn-back {
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            gap: 6px;
            width: 100%; 
            padding: 12px; 
            margin-top: 20px; 
            font-size: 0.9rem; 
            font-weight: 500;
            color: var(--text-muted); 
            text-decoration: none; 
            border-radius: var(--input-radius);
            transition: all 0.2s; 
            background-color: transparent;
        }
        .btn-back:hover { color: var(--primary-color); background-color: #f1f5f9; }

        /* --- VALIDATION & MODAL --- */
        .input-error {
            border-color: #dc2626 !important;
            background-color: #fef2f2 !important;
        }
        .error-msg {
            color: #dc2626; font-size: 0.75rem; margin-top: 5px; display: none;
        }

        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            display: none; justify-content: center; align-items: center;
            z-index: 2000;
            padding: 20px;
        }
        .modal-overlay.active { display: flex; }

        .modal-content {
            background: white; padding: 30px; border-radius: var(--radius);
            text-align: center; max-width: 400px; width: 100%;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            animation: popIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes popIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }

        .success-icon {
            width: 70px; height: 70px; background: #dcfce7; color: #16a34a;
            border-radius: 50%; margin: 0 auto 15px; 
            display: flex; align-items: center; justify-content: center; font-size: 40px;
        }
        .modal-btn {
            background: var(--primary-color); color: white; border: none;
            padding: 10px 25px; border-radius: 8px; cursor: pointer; font-weight: 600; margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="reg-card">
        <!-- LOGO -->
        <div class="logo">
            <!-- Ganti src sesuai lokasi logo Anda -->
            <img src="../Gambar/logpmi.png" alt="Logo PMR" onerror="this.style.display='none'">
        </div>

        <h2>Pendaftaran Anggota</h2>
        <p class="subtitle">SMKN 1 CIBINONG - PMR MILLENIUM</p>

        <form id="pmrForm" novalidate>
            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                <div class="error-msg">Nama lengkap wajib diisi.</div>
            </div>

            <div class="row-2">
                <!-- Kelas -->
                <div class="form-group">
                    <label for="kelas">Kelas <span class="required">*</span></label>
                    <select id="kelas" name="kelas" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="10">Kelas 10</option>
                        <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option>
                    </select>
                    <div class="error-msg">Silakan pilih kelas.</div>
                </div>

                <!-- Jurusan / Asal Sekolah -->
                <div class="form-group">
                    <label for="sekolah">Jurusan <span class="required">*</span></label>
                    <input type="text" id="sekolah" name="sekolah" placeholder="Contoh: TKJ / RPL" required>
                    <div class="error-msg">Jurusan wajib diisi.</div>
                </div>
            </div>

            <!-- No HP -->
            <div class="form-group">
                <label for="nohp">Nomor WhatsApp <span class="required">*</span></label>
                <input type="tel" id="nohp" name="nohp" placeholder="08xxxxxxxxxx" required>
                <div class="error-msg">Nomor HP wajib diisi.</div>
            </div>

            <!-- Alasan -->
            <div class="form-group">
                <label for="alasan">Alasan Bergabung <span class="required">*</span></label>
                <textarea id="alasan" name="alasan" placeholder="Ceritakan motivasi Anda..." required></textarea>
                <div class="error-msg">Alasan wajib diisi.</div>
            </div>

            <!-- Prestasi (Dynamic) -->
            <div class="form-group achievement-wrapper">
                <label>Prestasi yang Pernah Diraih (Opsional)</label>
                <div id="achievementList">
                    <div class="achievement-item">
                        <input type="text" name="prestasi[]" placeholder="Contoh: Juara 1 Lomba Lari">
                    </div>
                </div>
                <button type="button" id="btnAddPrestasi" class="btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Prestasi Lain
                </button>
            </div>

            <button type="submit" class="btn-submit">Kirim Pendaftaran</button>
        </form>

        <!-- Tombol Kembali -->
        <a href="../Halaman Utama/index.html" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

    <!-- MODAL SUKSES -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <div class="success-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3 style="margin-bottom: 10px; color: var(--text-main);">Pendaftaran Berhasil!</h3>
            <p style="font-size: 0.9rem; color: var(--text-muted);">Terima kasih. Data Anda telah kami terima.</p>
            <button class="modal-btn" onclick="closeModal()">Tutup</button>
        </div>
    </div>

    <!-- Font Awesome untuk Icon (opsional, tapi disarankan agar icon + muncul) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('pmrForm');
            const btnAddPrestasi = document.getElementById('btnAddPrestasi');
            const achievementList = document.getElementById('achievementList');
            const modal = document.getElementById('successModal');

            // --- Logic Tambah Prestasi ---
            btnAddPrestasi.addEventListener('click', () => {
                const newDiv = document.createElement('div');
                newDiv.className = 'achievement-item';
                
                const newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.name = 'prestasi[]';
                newInput.placeholder = 'Prestasi lainnya...';
                
                const btnRemove = document.createElement('button');
                btnRemove.type = 'button';
                btnRemove.className = 'btn-remove';
                btnRemove.innerHTML = '<i class="fa-solid fa-trash"></i>';
                
                btnRemove.addEventListener('click', function() {
                    newDiv.remove();
                });

                newDiv.appendChild(newInput);
                newDiv.appendChild(btnRemove);
                achievementList.appendChild(newDiv);
            });

            // --- Logic Validasi Form ---
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                let isValid = true;

                const requiredInputs = form.querySelectorAll('[required]');
                
                requiredInputs.forEach(input => {
                    const errorMsg = input.nextElementSibling;
                    input.classList.remove('input-error');
                    if(errorMsg) errorMsg.style.display = 'none';

                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('input-error');
                        if(errorMsg) errorMsg.style.display = 'block';
                    }
                });

                if (isValid) {
                    // Jika Validasi Sukses
                    modal.classList.add('active');
                    form.reset();
                    // Reset prestasi field
                    achievementList.innerHTML = `
                        <div class="achievement-item">
                            <input type="text" name="prestasi[]" placeholder="Contoh: Juara 1 Lomba Lari">
                        </div>
                    `;
                } else {
                    // Scroll ke error
                    const firstError = document.querySelector('.input-error');
                    if(firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        });

        function closeModal() {
            document.getElementById('successModal').classList.remove('active');
        }
    </script>
</body>
</html>