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

// Get username from session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Query to fetch recipes created by the user
$sql_recipes = "SELECT id, nama_resep, deskripsi, gambar FROM recipes WHERE author_name = ?";
$stmt_recipes = $koneksidb->prepare($sql_recipes);
$stmt_recipes->bind_param('s', $username);
$stmt_recipes->execute();
$result_recipes = $stmt_recipes->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <h1>User Profile</h1>
        <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
        <a href="editprofile.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </header>

    <!-- Recipe List -->
    <section class="recipe-list">
        <h2>Recipes Created by You</h2>
        <div class="recipes">
            <?php while ($row = $result_recipes->fetch_assoc()) : ?>
                <div class="recipe">
                    <h3><?php echo htmlspecialchars($row['nama_resep']); ?></h3>
                    <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                    <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama_resep']); ?>">
                    <a href="editresep.php?id=<?php echo urlencode($row['id']); ?>">Edit</a>
                    <a href="deleterecipe.php?id=<?php echo urlencode($row['id']); ?>">Delete</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

</body>
</html>

<?php
// Close prepared statement and database connection
$stmt_recipes->close();
$koneksidb->close();
?>
