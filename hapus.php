<?php
require_once 'config.php';

// Cek apakah ada parameter id
if (isset($_GET['id'])) {
    // Ambil id dari query string
    $id = mysqli_real_escape_string($db, $_GET['id']);
    
    // Get the photo path before deleting the record
    $sql_select = "SELECT foto FROM siswa WHERE id = $id";
    $query_select = mysqli_query($db, $sql_select);
    $foto_path = null;
    
    if($query_select && mysqli_num_rows($query_select) > 0) {
        $row = mysqli_fetch_assoc($query_select);
        $foto_path = $row['foto'];
    }
    
    // Query untuk menghapus data
    $sql = "DELETE FROM siswa WHERE id = $id";
    $query = mysqli_query($db, $sql);
    
    // Cek apakah query berhasil
    if ($query) {
        // Delete the photo file if it exists
        if($foto_path && file_exists($foto_path)) {
            unlink($foto_path);
        }
        
        // Jika berhasil, alihkan ke halaman list-siswa dengan status hapus_sukses
        header('Location: index.php?status=hapus_sukses');
    } else {
        // Jika gagal, alihkan ke halaman list-siswa dengan status hapus_gagal
        header('Location: index.php?status=hapus_gagal');
    }
} else {
    // Jika tidak ada parameter id, kembalikan ke halaman list-siswa
    header('Location: list-siswa.php');
}
?>