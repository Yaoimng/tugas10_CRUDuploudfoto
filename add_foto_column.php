<?php
require_once 'config.php';

// Add foto column to siswa table if it doesn't exist already
$result = mysqli_query($db, "SHOW COLUMNS FROM siswa LIKE 'foto'");
if(mysqli_num_rows($result) == 0) {
    $query = "ALTER TABLE siswa ADD foto VARCHAR(255) DEFAULT NULL";
    if(mysqli_query($db, $query)) {
        echo "Successfully added 'foto' column to 'siswa' table.";
    } else {
        echo "Error adding column: " . mysqli_error($db);
    }
} else {
    echo "'foto' column already exists in 'siswa' table.";
}
?>
