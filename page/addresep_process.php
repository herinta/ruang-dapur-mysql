<?php
session_start();

// Include database connection
include_once 'koneksidb.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

// Get user data from session
$email = $_SESSION['email'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $nama_resep = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $durasi = $_POST['durasi'];
    $bahan = $_POST['bahan'];
    $langkah = $_POST['langkah'];

    // Upload gambar resep
    $gambar_name = $_FILES['gambar']['name'];
    $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
    $upload_dir = 'uploads/'; // Direktori tempat menyimpan gambar resep
    $gambar_path = $upload_dir . basename($gambar_name);

    // Move uploaded file to specified directory
    move_uploaded_file($gambar_tmp_name, $gambar_path);

    // Upload gambar langkah-langkah
    $langkah_gambar_paths = [];
    $langkah_gambar_dir = 'uploads/langkah/'; // Direktori tempat menyimpan gambar langkah-langkah

    // Loop through each langkah to upload its image
    for ($i = 0; $i < count($langkah); $i++) {
        $langkah_gambar_name = $_FILES['langkah_gambar']['name'][$i];
        $langkah_gambar_tmp_name = $_FILES['langkah_gambar']['tmp_name'][$i];
        $langkah_gambar_path = $langkah_gambar_dir . basename($langkah_gambar_name);
        $langkah_gambar_paths[] = $langkah_gambar_path;

        // Upload file
        move_uploaded_file($langkah_gambar_tmp_name, $langkah_gambar_path);
    }

    // Insert data into database
    $sql = "INSERT INTO recipes (nama_resep, deskripsi, durasi, bahan, langkah, gambar, langkah_gambar, author_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $koneksidb->prepare($sql);
    $author_name = htmlspecialchars($name);
    $bahan_str = implode(', ', $bahan);
    $langkah_str = implode(', ', $langkah);
    $langkah_gambar_paths_str = implode(', ', $langkah_gambar_paths);

    $stmt->bind_param('ssssssss', $nama_resep, $deskripsi, $durasi, $bahan_str, $langkah_str, $gambar_path, $langkah_gambar_paths_str, $author_name);
    $stmt->execute();

    // Redirect to katalog.php or other appropriate page after successful submission
    header('Location: katalog.php');
    exit();
}

// Close database connection
$koneksidb->close();
?>
