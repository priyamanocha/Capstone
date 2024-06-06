<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
    $sql = "SELECT * FROM user_details WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Invalid email or password!";
        header("Location: http://localhost/php_program/capstone/Capstone/ResidenceRevive/html/login.html");
        exit();
    }
    
    $stmt->close();
    $conn->close();
}
?>
