<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $password = htmlspecialchars($_POST['password']);
    
   
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO user_details (email, first_name, last_name, contact_number, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $email, $first_name, $last_name, $contact_number, $hashed_password);
    
    if ($stmt->execute()) {
        $_SESSION['db_message'] = "Account created successfully!";
    } else {
        $_SESSION['db_message'] = "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
    
    header("Location: signup.php");
    exit();
}
?>
