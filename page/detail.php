<?php

session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

// Get user data from session
$email = $_SESSION['email'];
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

// Debugging: Print session data



// Include database connection
include_once 'koneksidb.php';

// Check if ID parameter exists in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: katalog.php');
    exit();
}

// Get recipe ID from URL parameter
$id = $_GET['id'];

// Query to fetch recipe details by ID
$sql = "SELECT * FROM recipes WHERE id = ?";
$stmt = $koneksidb->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if recipe exists
if ($result->num_rows == 0) {
    // Redirect to list page if recipe not found
    header('Location: listresep.php');
    exit();
}

// Fetch recipe details
$row = $result->fetch_assoc();
$nama_resep = htmlspecialchars($row['nama_resep']);
$deskripsi = htmlspecialchars($row['deskripsi']);
$gambar = htmlspecialchars($row['gambar']);
$author_name = htmlspecialchars($row['author_name']);
$durasi = htmlspecialchars($row['durasi']);
$bahan = htmlspecialchars($row['bahan']);

// Split langkah-langkah and langkah_gambar into arrays
$langkah = explode(', ', $row['langkah']);
$langkah_gambar_paths = explode(', ', $row['langkah_gambar']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Dapur</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
     <!-- Navbar -->
<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="HomePage.php" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="assets/logo.png" class="h-8" />
  </a>
  <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 dark:text-white"><?php echo htmlspecialchars($username); ?></span>
          <span class="block text-sm  text-gray-500 truncate dark:text-gray-400"><?php echo $email; ?></span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
          </li>
          <li>
            <a href="addresep.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Add Recipe</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
          </li>
        </ul>
      </div>
      <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 -ml-28" id="navbar-user">
    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      <li>
        <a href="HomePage.php" class="block py-2 px-3 text-white bg-orange-700 rounded md:bg-transparent md:text-orange-700 md:p-0 md:dark:text-orange-500" aria-current="page">Home</a>
      </li>
      <li>
        <a href="katalog.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-orange-700 md:p-0 dark:text-white md:dark:hover:text-orange-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Recipe</a>
      </li>
      <li>
        <a href="artikel.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-orange-700 md:p-0 dark:text-white md:dark:hover:text-orange-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Artikel</a>
      </li>
    </ul>
  </div>
  </div>
</nav>
    <div class="detail bg-gray-100 pt-16">
       <div class="container">
        <div class="max-w-4xl mx-auto p-4 flex flex-col md:flex-row">
            <div class="md:w-2/3">
              <img src="<?php echo $gambar; ?>" alt="<?php echo $nama_resep; ?>" class="w-full h-96  object-center   rounded-lg shadow-md">
              <div class="bg-white rounded-xl mt-6 py-6 px-8">
                <h2 class="text-2xl font-bold "><?php echo $nama_resep; ?></h2>
                <p><?php echo $deskripsi; ?></p>
              </div>
              <div class="bg-white rounded-xl mt-6 py-6 px-8">
                <h1 class="font-semibold mb-5 text-xl">Bahan-Bahan</h1>
                <ul class="list-disc pl-5 space-y-2">
                <?php
                    // Convert $bahan string to array
                    $bahan_array = explode(', ', $bahan);
                    foreach ($bahan_array as $bahan_item) {
                        echo '<li>' . htmlspecialchars($bahan_item) . '</li>';
                    }
                    ?>
                </ul>
              </div>
              <div class="bg-white rounded-xl mt-6 py-6 px-8">
                <h2 class="font-bold text-xl mb-4">Cara Membuat</h2>
                <?php for ($i = 0; $i < count($langkah); $i++): ?>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Langkah <?php echo ($i + 1); ?>:</h3>
                        <p><?php echo htmlspecialchars($langkah[$i]); ?></p>
                        <?php if (!empty($langkah_gambar_paths[$i])): ?>
                            <img src="<?php echo htmlspecialchars($langkah_gambar_paths[$i]); ?>" alt="Langkah <?php echo ($i + 1); ?>" class="mt-4 rounded-lg">
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
               
                </div>
            </div>
            <div class="md:w-1/3 md:pl-6">
              <div class="bg-white p-4 rounded-lg shadow-lg">
                
                <button class="bg-orange-400 text-white py-2 px-4 rounded-lg w-full mb-2">Simpan Resep</button>
                <button class="bg-white text-zinc-700 border border-zinc-300 py-2 px-4 rounded-lg w-full mb-2">Bagikan</button>
                <button class="bg-white text-zinc-700 border border-zinc-300 py-2 px-4 rounded-lg w-full mb-2">Print</button>
                
              </div>
            </div>
          </div>
          
       </div>
    </div>
</body>
</html>

<?php
// Close database connection
$stmt->close();
$koneksidb->close();
?>