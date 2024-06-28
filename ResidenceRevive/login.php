<!-- We are starting the session in order to track user login and other session-related information -->

<?php session_start(); ?>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Residence Revive</title>
    <!-- The link to external CSS stylesheets -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login_styles.css">
</head>

<body>
    <!-- Including the header from a separate PHP file -->
    <?php include 'includes/header.php'; ?>

    <!-- The container for the login form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Login to Residence Revive</h2>
                <!-- The login form that sends a POST request to login_action.php when the user submit the form -->
                <form action="login.php" method="POST">
                    <p>New to here? Create a new account? <a href="../Pages/signup.php">Signup</a></p>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Including the footer from a separate PHP file -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>