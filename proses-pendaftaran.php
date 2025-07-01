<?php
require_once 'config.php';

// Cek apakah tombol daftar sudah diklik
if (isset($_POST['daftar'])) {
    // Ambil data dari formulir
    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $jenis_kelamin = mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
    $agama = mysqli_real_escape_string($db, $_POST['agama']);
    $sekolah_asal = mysqli_real_escape_string($db, $_POST['sekolah_asal']);
    
    // Default foto path (jika tidak ada upload)
    $foto_path = NULL;
    
    // Proses upload foto jika ada
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        // Folder untuk menyimpan foto
        $upload_dir = 'uploads/';
        
        // Buat direktori jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Mendapatkan info file
        $file_name = basename($_FILES['foto']['name']);
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_size = $_FILES['foto']['size'];
        
        // Menentukan ekstensi file yang diizinkan
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        
        // Cek ekstensi file
        if(in_array(strtolower($file_ext), $allowed_extensions)) {
            // Cek ukuran file (maks 2MB)
            if($file_size <= 2 * 1024 * 1024) {
                // Generate unique name
                $new_file_name = uniqid() . '.' . $file_ext;
                $upload_path = $upload_dir . $new_file_name;
                
                // Upload file
                if(move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                    $foto_path = $upload_path;
                }
            }
        }
    }
    
    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal, foto) 
            VALUES ('$nama', '$alamat', '$jenis_kelamin', '$agama', '$sekolah_asal', " . 
            ($foto_path ? "'$foto_path'" : "NULL") . ")";
    
    // Eksekusi query
    $query = mysqli_query($db, $sql);
    
    // Cek apakah query berhasil
    if ($query) {
        // Jika berhasil, alihkan ke halaman index dengan status sukses
        header('Location: index.php?status=sukses');
    } else {
        // Jika gagal, alihkan ke halaman index dengan status gagal
        header('Location: index.php?status=gagal');
    }
} else {
    // Jika tombol daftar tidak diklik, kembalikan ke halaman index
    header('Location: index.php');
}
?>