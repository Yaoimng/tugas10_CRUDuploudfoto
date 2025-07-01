<?php
require_once 'config.php';

// Cek apakah tombol simpan sudah diklik
if (isset($_POST['simpan'])) {
    // Ambil data dari formulir
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
    $jenis_kelamin = mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
    $agama = mysqli_real_escape_string($db, $_POST['agama']);
    $sekolah_asal = mysqli_real_escape_string($db, $_POST['sekolah_asal']);
    $foto_lama = isset($_POST['foto_lama']) ? $_POST['foto_lama'] : NULL;
    
    // Variabel untuk menyimpan path foto
    $foto_path = $foto_lama;
    
    // Proses upload foto baru jika ada
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
                    // Jika berhasil upload, hapus foto lama jika ada
                    if($foto_lama && file_exists($foto_lama) && $foto_lama != $upload_path) {
                        unlink($foto_lama);
                    }
                    $foto_path = $upload_path;
                }
            }
        }
    }
    
    // Query untuk memperbarui data siswa
    $sql = "UPDATE siswa SET 
            nama='$nama', 
            alamat='$alamat', 
            jenis_kelamin='$jenis_kelamin', 
            agama='$agama', 
            sekolah_asal='$sekolah_asal',
            foto=" . ($foto_path ? "'$foto_path'" : "NULL") . "
            WHERE id=$id";
    
    // Eksekusi query
    $query = mysqli_query($db, $sql);
    
    // Cek apakah query berhasil
    if ($query) {
        // Jika berhasil, alihkan ke halaman index dengan status edit_sukses
        header('Location: index.php?status=edit_sukses');
    } else {
        // Jika gagal, alihkan ke halaman index dengan status edit_gagal
        header('Location: index.php?status=edit_gagal');
    }
} else {
    // Jika tombol simpan tidak diklik, kembalikan ke halaman index
    header('Location: index.php');
}
?>