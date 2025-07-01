<?php
require_once 'config.php';

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    header('Location: list-siswa.php');
    exit;
}

// Ambil id dari query string
$id = mysqli_real_escape_string($db, $_GET['id']);

// Query untuk mengambil data siswa berdasarkan id
$sql = "SELECT * FROM siswa WHERE id = $id";
$query = mysqli_query($db, $sql);

// Cek apakah data ditemukan
if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}

// Ambil data siswa
$siswa = mysqli_fetch_assoc($query);

// Simpan data dalam variabel untuk memudahkan penggunaan di form
$nama = htmlspecialchars($siswa['nama']);
$alamat = htmlspecialchars($siswa['alamat']);
$jenis_kelamin = $siswa['jenis_kelamin'];
$agama = htmlspecialchars($siswa['agama']);
$sekolah_asal = htmlspecialchars($siswa['sekolah_asal']);
$foto = $siswa['foto'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
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
            <h2><span class="blink">★</span> EDIT DATA SISWA <span class="blink">★</span></h2>
        </header>
        
        <div class="nav-menu">
            <a href="list-siswa.php" class="btn btn-warning">← Kembali ke Daftar Siswa</a>
        </div>
        
        <form action="proses-edit.php" method="POST" enctype="multipart/form-data">
            <!-- Menyertakan id siswa dalam form sebagai hidden input -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" rows="4" required><?php echo $alamat; ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'checked'; ?> required>
                        <label for="laki">Laki-laki</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'checked'; ?>>
                        <label for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="agama">Agama:</label>
                <select id="agama" name="agama" required>
                    <option value="">Pilih Agama</option>
                    <option value="Islam" <?php if ($agama == 'Islam') echo 'selected'; ?>>Islam</option>
                    <option value="Kristen" <?php if ($agama == 'Kristen') echo 'selected'; ?>>Kristen</option>
                    <option value="Katolik" <?php if ($agama == 'Katolik') echo 'selected'; ?>>Katolik</option>
                    <option value="Hindu" <?php if ($agama == 'Hindu') echo 'selected'; ?>>Hindu</option>
                    <option value="Buddha" <?php if ($agama == 'Buddha') echo 'selected'; ?>>Buddha</option>
                    <option value="Konghucu" <?php if ($agama == 'Konghucu') echo 'selected'; ?>>Konghucu</option>
                    <option value="Lainnya" <?php if ($agama == 'Lainnya') echo 'selected'; ?>>Lainnya</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="sekolah_asal">Sekolah Asal:</label>
                <input type="text" id="sekolah_asal" name="sekolah_asal" value="<?php echo $sekolah_asal; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="foto">Foto Siswa:</label>
                <?php if($foto && file_exists($foto)): ?>
                    <div class="current-photo">
                        <img src="<?php echo $foto; ?>" alt="Foto <?php echo $nama; ?>" class="student-photo">
                        <p>Foto saat ini</p>
                    </div>
                <?php endif; ?>
                <input type="file" id="foto" name="foto" accept="image/*" class="file-input">
                <p class="file-info">Format: JPG, PNG, atau GIF. Maks: 2MB</p>
                <input type="hidden" name="foto_lama" value="<?php echo $foto; ?>">
            </div>
            
            <div style="text-align: center;">
                <button type="submit" name="simpan" class="btn btn-success">Simpan Perubahan</button>
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