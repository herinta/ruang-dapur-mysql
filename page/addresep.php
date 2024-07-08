<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

// Include database connection
include_once 'koneksidb.php';

// Initialize variables
$errors = array();
$recipe = array();
$bahan = array();
$langkah = array();

// Fetch recipe details based on ID
if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    // Query to fetch recipe details
    $sql_recipe = "SELECT * FROM recipes WHERE id = ?";
    $stmt_recipe = $koneksidb->prepare($sql_recipe);
    $stmt_recipe->bind_param('i', $recipe_id);
    $stmt_recipe->execute();
    $result_recipe = $stmt_recipe->get_result();

    // Fetch recipe details
    if ($result_recipe->num_rows > 0) {
        $recipe = $result_recipe->fetch_assoc();

        // Query to fetch ingredients (bahan)
        $sql_bahan = "SELECT * FROM ingredients WHERE recipe_id = ?";
        $stmt_bahan = $koneksidb->prepare($sql_bahan);
        $stmt_bahan->bind_param('i', $recipe_id);
        $stmt_bahan->execute();
        $result_bahan = $stmt_bahan->get_result();

        // Fetch ingredients
        while ($row_bahan = $result_bahan->fetch_assoc()) {
            $bahan[] = $row_bahan;
        }

        // Query to fetch steps (langkah-langkah)
        $sql_langkah = "SELECT * FROM steps WHERE recipe_id = ?";
        $stmt_langkah = $koneksidb->prepare($sql_langkah);
        $stmt_langkah->bind_param('i', $recipe_id);
        $stmt_langkah->execute();
        $result_langkah = $stmt_langkah->get_result();

        // Fetch steps
        while ($row_langkah = $result_langkah->fetch_assoc()) {
            $langkah[] = $row_langkah;
        }
    } else {
        // Redirect to error page or handle error
        header('Location: error.php');
        exit();
    }

    // Close prepared statements
    $stmt_recipe->close();
    $stmt_bahan->close();
    $stmt_langkah->close();
} else {
    // Redirect to error page or handle error
    header('Location: error.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and process form data
    // For simplicity, assume processing logic is handled similarly to addresep_process.php

    // Redirect to recipe page or confirmation page after updating
    header('Location: recipe.php?id=' . $recipe_id);
    exit();
}

// Close database connection
$koneksidb->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe - <?php echo htmlspecialchars($recipe['nama_resep']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/style.css">
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

    <div class="">
        <div class="containerr">
            <div class="add-img mt-20">          
                <div class="flex items-center justify-center w-1/4">
                    <form action="editresep_process.php" method="POST" enctype="multipart/form-data">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" name="gambar" type="file" class="hidden" onchange="previewImage(event)" />
                        </label>
                        <img id="preview" class="mt-4 hidden" />
                    
                    <div class="mb-5">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Resep</label>
                        <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" value="<?php echo htmlspecialchars($recipe['nama_resep']); ?>" required />
                    </div>
                    <div class="mb-6">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea  id="deskripsi" rows="4" name="deskripsi" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Tentang Makanan..."><?php echo htmlspecialchars($recipe['deskripsi']); ?></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Perkiraan Durasi</label>
                        <input type="text" id="durasi" name="durasi" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" value="<?php echo htmlspecialchars($recipe['durasi']); ?>">
                    </div>

                   <!-- Bahan - Bahan -->
                    <div id="bahan-container">
                        <?php foreach ($bahan as $index => $ingredient): ?>
                        <div class="mb-6 bahan-item">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bahan - Bahan <?php echo $index + 1; ?></label>
                            <input name="bahan[]" type="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" value="<?php echo htmlspecialchars($ingredient['nama_bahan']); ?>" required>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" onclick="addBahan()" class="text-orange-700 border border-orange-700 px-4 py-2 rounded-lg hover:bg-orange-700 hover:text-white dark:hover:bg-orange-500 dark:hover:text-white">Tambah Bahan</button>

                    <!-- Langkah - Langkah -->
                    <div id="langkah-container">
                        <?php foreach ($langkah as $index => $step): ?>
                        <div class="mb-6 langkah-item">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Langkah - Langkah <?php echo $index + 1; ?></label>
                            <input name="langkah[]" type="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" value="<?php echo htmlspecialchars($step['langkah']); ?>" required>

                            <!-- Input untuk upload gambar langkah -->
                            <input name="langkah_gambar[]" type="file" class="block mt-2" onchange="previewLangkahGambar(event)" accept="image/*">
                            <img class="mt-2 hidden" id="preview-langkah" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <button type="button" onclick="addLangkah()" class="text-orange-700 border border-orange-700 px-4 py-2 rounded-lg hover:bg-orange-700 hover:text-white dark:hover:bg-orange-500 dark:hover:text-white">Tambah Langkah</button>

                    <div class="">
                    <button type="submit" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Submit</button>
                
                    </div>
                    </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script>
        // Function to preview image before upload
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.classList.remove('hidden'); // Show the preview image
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Function to add a new input field for bahan
    function addBahan() {
        var container = document.getElementById('bahan-container');
        var newItem = document.createElement('div');
        newItem.classList.add('mb-6', 'bahan-item');
        newItem.innerHTML = `
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
            <input name="bahan[]" type="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Tambahkan Bahan" required>
        `;
        container.appendChild(newItem);
    }

    // Function to add a new input field for langkah-langkaha
    // Function to add a new input field for langkah-langkah
function addLangkah() {
    var container = document.getElementById('langkah-container');
    var newItem = document.createElement('div');
    newItem.classList.add('mb-6', 'langkah-item');
    newItem.innerHTML = `
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Langkah - Langkah</label>
        <input name="langkah[]" type="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Tambahkan Langkah" required>
        
        <!-- Input untuk upload gambar langkah -->
        <input name="langkah_gambar[]" type="file" class="block mt-2" onchange="previewLangkahGambar(event)" accept="image/*">
        <img class="mt-2 hidden" id="preview-langkah" />
    `;
    container.appendChild(newItem);
}

// Function to preview image before upload for langkah-langkah
function previewLangkahGambar(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = event.target.nextElementSibling;
        output.src = reader.result;
        output.classList.remove('hidden'); // Show the preview image
    }
    reader.readAsDataURL(event.target.files[0]);
}

    </script>

</body>
</html>
