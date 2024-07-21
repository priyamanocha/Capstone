<!-- We are starting the session in order to track user login and other session-related information -->

<?php
$email = $password = "";
$email_err = $password_err = $email_password_err = "";

// Including the database configuration file to establish a db connection
include 'config/db.php';

// Checking if my request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Validate Email
    if (empty($_POST["email"])) {
        $email_err = "Email is required.";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $password_err = "Password is required.";
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    if (empty($email_err) && empty($password_err)) {

        // Preparing the SQL query to select the user details 
        $sql = "SELECT * FROM user_details WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // We are check if the user exists along with the fact that the provided password matches the stored password
        if ($user && password_verify($password, $user['password'])) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            header("Location: index.php");
            // exit();
        } else {
            // If the user login fails, store an error message in the session
            $email_password_err = "Invalid email/password combination";
        }
        // Closing the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Page Residence Revive">
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
                    <p>Create an account? <a href="signup.php">Register</a></p>
                    <div class="form-group">
                <span class="error"><?php echo $email_password_err; ?></span>
            </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                        <span class="error"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="error"><?php echo $password_err; ?></span>
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