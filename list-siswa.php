<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa Terdaftar</title>
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
            <h2><span class="blink">★</span> DAFTAR SISWA TERDAFTAR <span class="blink">★</span></h2>
        </header>
        
        <div class="marquee">
            <span>Daftar siswa yang telah mendaftar dalam sistem pendaftaran siswa baru tahun ajaran 2025/2026. Admin: <?php echo htmlspecialchars('Yaoimng'); ?> - Tanggal: <?php echo date('Y-m-d H:i:s'); ?></span>
        </div>
        
        <div class="nav-menu">
            <a href="index.php" class="btn btn-warning">← Kembali ke Beranda</a>
            <a href="form-daftar.php" class="btn btn-primary">Tambah Siswa Baru</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Sekolah Asal</th>
                    <th>Tanggal Daftar</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil data siswa
                $sql = "SELECT * FROM siswa ORDER BY id DESC";
                $query = mysqli_query($db, $sql);
                
                if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($siswa = mysqli_fetch_array($query)) {
                        // Format tanggal
                        $tanggal_daftar = new DateTime($siswa['tanggal_daftar']);
                        $formatted_date = $tanggal_daftar->format('d-m-Y H:i:s');
                        
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        echo "<td>";
                        if($siswa['foto'] && file_exists($siswa['foto'])) {
                            echo "<img src='".$siswa['foto']."' alt='Foto ".htmlspecialchars($siswa['nama'])."' class='student-thumbnail'>";
                        } else {
                            echo "<img src='uploads/default.png' alt='No Photo' class='student-thumbnail'>";
                        }
                        echo "</td>";
                        echo "<td>".htmlspecialchars($siswa['nama'])."</td>";
                        echo "<td>".htmlspecialchars($siswa['alamat'])."</td>";
                        echo "<td>".htmlspecialchars($siswa['jenis_kelamin'])."</td>";
                        echo "<td>".htmlspecialchars($siswa['agama'])."</td>";
                        echo "<td>".htmlspecialchars($siswa['sekolah_asal'])."</td>";
                        echo "<td>".$formatted_date."</td>";
                        echo "<td class='action-buttons'>";
                        echo "<a href='form-edit.php?id=".$siswa['id']."' class='btn btn-warning'>Edit</a>";
                        echo "<a href='hapus.php?id=".$siswa['id']."' class='btn btn-danger' onclick='return confirm(\"Yakin hapus data?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='9' style='text-align: center;'>Belum ada data siswa</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div style="text-align: center; margin-top: 20px;">
            <p>Total: <b><?php echo mysqli_num_rows($query); ?></b> siswa</p>
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