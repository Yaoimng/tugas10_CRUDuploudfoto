<?php
// Database connection parameters
$server = "localhost";
$user = "root";
$password = "";

// Connect without selecting a database
$conn = mysqli_connect($server, $user, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS pendaftaran_siswa";
if (mysqli_query($conn, $sql_create_db)) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
    exit;
}

// Select the database
mysqli_select_db($conn, "pendaftaran_siswa");

// Create siswa table if it doesn't exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS siswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(64) NOT NULL,
    alamat TEXT,
    jenis_kelamin VARCHAR(16) NOT NULL,
    agama VARCHAR(16) NOT NULL,
    sekolah_asal VARCHAR(64) NOT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql_create_table)) {
    echo "Table 'siswa' created successfully or already exists<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Create uploads directory if it doesn't exist
$upload_dir = __DIR__ . "/uploads";
if (!file_exists($upload_dir)) {
    if (mkdir($upload_dir, 0777, true)) {
        echo "Uploads directory created successfully<br>";
    } else {
        echo "Failed to create uploads directory<br>";
    }
} else {
    echo "Uploads directory already exists<br>";
}

// Create default.png if it doesn't exist
$default_image_path = $upload_dir . "/default.png";
if (!file_exists($default_image_path)) {
    // Simple 1x1 transparent PNG data
    $default_png_data = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAADW0lEQVR4nO3dS2sTURjG8X9qL9qqVFyIoBG8IKIbQfGGCxV0IYiCK8GlCr0hLkRw4Q3Eqz+gH0AQunMnCCKKC1GkolWrVRQvS0XbWi/jQiWNzeTMOXPmzIvzgyQwJHn6TObk5MybgIiIiIiIiIiIiIhIePqBCWAWWAYywCQwBFRVcN8QbPRvKqoPoJqDH2sZrxXcv6lU/EXvA2aAGnAb6AR2AoPAZ+AXcC/w/kGk/B3H+RfH3JfKuA6MB/66ilXxF4uNGE2pZw1YAbYB7YHKCGXUf3l04iNNlYMiYqmGD8YicD5AGaHU8MGYCri/K4Vm4J6Iy6b2AbgRsIxQai0cE4rLt6yUOg4cBJ4An4DPwFSNx1c5KKG0A0dx//ErXhm1Dl8dVcBHCvxwE+4n+G6KvEhTaRZf0jbgOZv/YC+BnRUqI5SmDl+dFH6ReIR7YeAOMBawDFeaPnzVgFfALu9qIuaA2QDbuZDSWMMmMIHvTr3baFvRCUzjf7K0HSsU+XBvNaXAaZspfEfqO9LtpDCFb90Ufkba9o+kTOH7Y9uvVaXwjdYC7y+VvvAcT+HfKqyHrSoHp7qvUwrfWNbhC7cuvN6qQrPCt6ZFXCeGWzV8a1rFdXxeq/iLNQtfL9/xM8DgVha+XqsVvl7uwldHVuHr5TJ8vVSFr5fr8PX6Z/ieLGMeJV/4QmXC18s3fJsoI3y9jgBPKfME0ha+XuXCt4kyw9fr/2aB/Yd/Dh++XlnCd0cEZUg17MQ9WXcC9ymxyDMxCk+FiX9YKP4VkN0RlCHVUG/46udYvb2thXwRlCHVUGj4KvkvQm+MoAyphkLhKxKUMuHrpfBNocbCV1aobJmwTR2+sjIKX68owzdnxbZcU4evl5WkKHy9LCVJb1niXSzC12tthQ+TcKnC10vhG0Gp8PWyGr4UWLkUVeHrZTV8KRLCuhW+XtbDlwI/pPD1sh6+JG6O36iXsBy+qp0V0+pMhG+uWPHu8DVhtcjCN5eN8DVjK6zC16uS4eut3qylqsCLrT5dTZK4DaRrhc4FqzWIlWsvQ5PChF+lkX4UFBEREZG0+QsnvYWg8qPXawAAAABJRU5ErkJggg==');
    
    if (file_put_contents($default_image_path, $default_png_data)) {
        echo "Default profile image created successfully<br>";
    } else {
        echo "Failed to create default profile image<br>";
    }
} else {
    echo "Default profile image already exists<br>";
}

echo "<p>Database setup complete! You can now <a href='index.php'>go to the main page</a>.</p>";

mysqli_close($conn);
?>
