<?php require_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru</title>
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
            <h1><span class="blink">★</span> PENDAFTARAN SISWA BARU <span class="blink">★</span></h1>
        </header>
        
        <div class="marquee">
            <span>Selamat datang di sistem pendaftaran siswa baru tahun ajaran 2025/2026. Admin: <?php echo htmlspecialchars('Yaoimng'); ?> - Tanggal: <?php echo date('Y-m-d H:i:s'); ?></span>
        </div>
        
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'sukses') {
                echo '<div class="message success">Pendaftaran siswa baru berhasil!</div>';
            } elseif ($_GET['status'] == 'gagal') {
                echo '<div class="message error">Pendaftaran siswa baru gagal!</div>';
            } elseif ($_GET['status'] == 'hapus_sukses') {
                echo '<div class="message success">Data siswa berhasil dihapus!</div>';
            } elseif ($_GET['status'] == 'hapus_gagal') {
                echo '<div class="message error">Data siswa gagal dihapus!</div>';
            } elseif ($_GET['status'] == 'edit_sukses') {
                echo '<div class="message success">Data siswa berhasil diperbarui!</div>';
            } elseif ($_GET['status'] == 'edit_gagal') {
                echo '<div class="message error">Data siswa gagal diperbarui!</div>';
            }
        }
        ?>
        
        <div class="nav-menu">
            <a href="form-daftar.php" class="btn btn-primary">Daftar Baru</a>
            <a href="list-siswa.php" class="btn btn-success">Lihat Semua Siswa</a>
        </div>
        
        <div style="text-align: center;">
            <img src="https://i.gifer.com/origin/cb/cb89e208be99a1bbe88a2b8c1b0fab4b_w200.gif" alt="Welcome Gif" style="max-width: 200px; margin: 20px auto;">
            <h3>Selamat Datang di Aplikasi Pendaftaran Siswa Baru</h3>
            <p>Aplikasi ini dibuat untuk memudahkan proses pendaftaran siswa baru. Silakan klik tombol di atas untuk mulai menggunakan aplikasi.</p>
        </div>
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