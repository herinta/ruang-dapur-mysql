<?php
session_start();

// Database configuration
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'resep_db';

// Establishing connection to database
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching data from login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs (you should add more validation/sanitization)
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to fetch user from database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Debugging: Print the user array
            echo "<pre>";
            print_r($user);
            echo "</pre>";

            if (password_verify($password, $user['password'])) {
                // Password correct, login successful
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username']; // Set the name in the session

                // Debugging: Print session data
                echo "<pre>";
                print_r($_SESSION);
                echo "</pre>";

                // Redirect to homepage or dashboard
                header('Location: HomePage.php');
                exit();
            } else {
                // Incorrect password
                echo "Login failed. Incorrect username or password.";
            }
        } else {
            // Email not found
            echo "Login failed. Incorrect username or password.";
        }
    } else {
        // Query error handling
        echo "Query error: " . $conn->error;
    }
}

$conn->close();
?>
