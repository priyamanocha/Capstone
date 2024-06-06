<?php
// Checking for the session, if is not already started, then start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Including the database configuration file to establish a db connection
include 'config/db.php';

// Checking if my request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Getting the email and password from the POST request
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
    // Preparing the SQL query to select the user details 
    $sql = "SELECT * FROM user_details WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
     // We are check if the user exists along with the fact that the provided password matches the stored password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: ../index.php");
        exit();
    } else {
        // If the user login fails, store an error message in the session
        $_SESSION['error_message'] = "Invalid email or password!";
        header("Location: /Pages/login.php");
        exit();
    }
    // Closing the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
