<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    include 'config/db.php';

 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    $sql = "INSERT INTO user_details (email, first_name, last_name, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("ssss", $email, $first_name, $last_name, $password);


    if ($stmt->execute()) {
        $_SESSION['db_message'] = "New record created successfully";
    } else {
        $_SESSION['db_message'] = "Error: " . $stmt->error;
    }

   
    $stmt->close();
    $conn->close();

 
    header('Location: html/signup.html');
    exit();
}
?>
