<!-- We are starting the session in order to track user login and other session-related information -->

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Residence Revive</title>
    <!-- The link to external CSS stylesheets -->
    <link rel="stylesheet" href="../css/login_styles.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
     <!-- Including the header from a separate PHP file -->
    <?php include '../includes/header.php'; ?>

    <!-- The container for the login form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Login to Residence Revive</h2>
                 <!-- The login form that sends a POST request to login_action.php when the user submit the form -->
                <form action="../login_action.php" method="POST">
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
    <?php include '../includes/footer.php'; ?>
</body>
</html>
