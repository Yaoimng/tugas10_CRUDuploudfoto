<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Siswa Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- 90s Decorative Elements -->
    <div class="decoration" style="top: 10%; left: 5%;">⭐</div>
    <div class="decoration" style="top: 20%; left: 90%;">🌈</div>
    <div class="decoration" style="top: 80%; left: 15%;">💾</div>
    <div class="decoration" style="top: 70%; left: 80%;">📼</div>
    <div class="decoration" style="top: 40%; left: 10%;">🎮</div>
    <div class="decoration" style="top: 30%; left: 85%;">📱</div>
    
    <div class="container">
        <header>
            <h2><span class="blink">★</span> FORMULIR PENDAFTARAN SISWA BARU <span class="blink">★</span></h2>
        </header>
        
        <div class="nav-menu">
            <a href="index.php" class="btn btn-warning">← Kembali ke Beranda</a>
            <a href="list-siswa.php" class="btn btn-success">Lihat Semua Siswa</a>
        </div>
        
        <form action="proses-pendaftaran.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" rows="4" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" required>
                        <label for="laki">Laki-laki</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                        <label for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="agama">Agama:</label>
                <select id="agama" name="agama" required>
                    <option value="">Pilih Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="sekolah_asal">Sekolah Asal:</label>
                <input type="text" id="sekolah_asal" name="sekolah_asal" required>
            </div>
            
            <div class="form-group">
                <label for="foto">Foto Siswa:</label>
                <input type="file" id="foto" name="foto" accept="image/*" class="file-input">
                <p class="file-info">Format: JPG, PNG, atau GIF. Maks: 2MB</p>
            </div>
            
            <div style="text-align: center;">
                <button type="submit" name="daftar" class="btn btn-primary">Daftar Sekarang</button>
            </div>
        </form>
    </div>
    
    <footer>
        <p>Copyright &copy; 2025 - Sistem Pendaftaran Siswa. Created with 💖 by Yaoimng</p>
        <p>Current Time: <span id="current-time"></span></p>
    </footer>
    
    <script>
        // Add some random stars for 90s effect
        for (let i = 0; i < 20; i++) {
            const star = document.createElement('div');
            star.classList.add('stars');
            star.style.left = `${Math.random() * 100}%`;
            star.style.top = `${Math.random() * 100}%`;
            document.body.appendChild(star);
        }
        
        // Current date and time
        const updateDateTime = () => {
            const now = new Date();
            const dateTimeStr = now.toLocaleString('id-ID');
            document.getElementById('current-time').textContent = dateTimeStr;
        };
        
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
</body>
</html>