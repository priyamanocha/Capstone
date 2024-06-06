<?php
// Starting the session to track  session-related information
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Including the database file to establish the database connection
    include 'config/db.php';

 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the user input from the POST request
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Preparing the query to insert the user details into the database
    $sql = "INSERT INTO user_details (email, first_name, last_name, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("ssss", $email, $first_name, $last_name, $password);

    // If the insertion done by the user was successful, then store a success message in the session
    if ($stmt->execute()) {
        $_SESSION['db_message'] = "New record created successfully";
    } else {
        $_SESSION['db_message'] = "Error: " . $stmt->error;
    }

     // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirecting the user to the signup page        
    header('Location: Pages/signup.php');
    exit();
}
?>
