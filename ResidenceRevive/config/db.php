<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// config/db.php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "residence_revive";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $_SESSION['db_message'] = "Connection failed: " . $conn->connect_error;
} else {
    $_SESSION['db_message'] = "Database connected successfully.";
}
?>
