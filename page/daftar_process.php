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

// Fetching data from registration form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Validate inputs (you should add more validation/sanitization)
$username = mysqli_real_escape_string($conn, $username);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);
$confirm_password = mysqli_real_escape_string($conn, $confirm_password);

// Check if passwords match
if ($password !== $confirm_password) {
    die("Password confirmation does not match.");
}

// Hash the password
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$password_hashed')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    // Redirect to login page or wherever appropriate
    header('Location: login.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
