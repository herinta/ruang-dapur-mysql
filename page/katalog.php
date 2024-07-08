<?php
// listresep.php

// Include database connection
include_once 'koneksidb.php';

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

// Initialize variables for search
$search = ''; // Default empty search string
$searchBy = 'nama_resep'; // Default search by recipe name

// Process search input if provided
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Sanitize search input to prevent SQL injection
    $search = $koneksidb->real_escape_string($search);
}

// Process search by option if provided
if (isset($_GET['searchBy']) && ($_GET['searchBy'] == 'nama_resep' || $_GET['searchBy'] == 'bahan')) {
    $searchBy = $_GET['searchBy'];
}

// Query to fetch recipes
$sql = "SELECT id, nama_resep, deskripsi, gambar, author_name FROM recipes";

// Add WHERE clause for search if keyword is provided
if (!empty($search)) {
    if ($searchBy == 'nama_resep') {
        $sql .= " WHERE nama_resep LIKE '%$search%'";
    } else if ($searchBy == 'bahan') {
        // Assuming 'bahan' is a column in your recipes table where ingredients are stored
        $sql .= " WHERE bahan LIKE '%$search%'";
    }
}

$sql .= " ORDER BY created_at DESC";
$result = $koneksidb->query($sql);

function truncate_words($text, $limit, $ellipsis = '...') {
    $words = explode(' ', $text);
    if (count($words) > $limit) {
        return implode(' ', array_slice($words, 0, $limit)) . $ellipsis;
    }
    return $text;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Dapur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-zinc-100">
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
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400"><?php echo $email; ?></span>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2 py-10">
                <form action="listresep.php" method="GET" class="mb-6">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" name="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Mau cari resep apa? ..." value="<?php echo htmlspecialchars($search); ?>" required />
                    </div>
                </form>

                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        <!-- Your tab buttons here -->
                    </ul>
                </div>

                <h1 class="text-2xl font-bold mb-4">Resep Populer</h1>

                <div class="space-y-3">
                    <?php
                    // Loop through query result and display each recipe
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="detail.php?id=' . urlencode($row['id']) . '" class="flex justify-between bg-white rounded-lg shadow">';
                        echo '<div class="description p-4">';
                        echo '<h2 class="text-xl font-semibold recipe-title">' . htmlspecialchars($row['nama_resep']) . '</h2>';
                        echo '<p>' . htmlspecialchars($row['author_name']) . '</p>';
                        echo '<p class="text-zinc-600 mt-1">' . htmlspecialchars(truncate_words($row['deskripsi'], 12, '...')) . '</p>';
                        echo '<div class="flex items-center mt-4">';
                        echo '<img class="w-5" src="assets/icon-time.png" alt="">';
                        echo '<span class="ml-2"><p>25 Menit</p></span>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="">';
                        echo '<img class="rounded-r-lg w-44 h-40 object-cover object-center" src="' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama_resep']) . '" />';
                        echo '</div>';
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('default-search');
            const recipeTitles = document.querySelectorAll('.recipe-title');

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();

                recipeTitles.forEach(function (title) {
                    const titleText = title.innerText.toLowerCase();

                    if (titleText.includes(searchTerm)) {
                        title.closest('.flex').style.display = 'flex'; // Show the recipe card
                    } else {
                        title.closest('.flex').style.display = 'none'; // Hide the recipe card
                    }
                });
            });
        });
    </script>
</body>
</html>
