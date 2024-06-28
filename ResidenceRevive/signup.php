<!-- We are starting the session in order to track user login and other session-related information -->
<?php session_start(); ?>
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- The link to external CSS stylesheets -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/signup_styles.css">
    <!-- The JavaScript function to check the strength of the password -->
    <script>
        function checkPasswordStrength(password) {
            let strengthBar = document.getElementById('strength-bar');
            let strength = 0;

            // The Array of regular expressions to test password strength for which the user input
            const regexes = [
                /.{8,}/,
                /[A-Z]/,
                /[a-z]/,
                /[0-9]/,
                /[^A-Za-z0-9]/
            ];

            // Testing the the password and increasing its strength for each match
            regexes.forEach((regex) => {
                if (regex.test(password)) {
                    strength++;
                }
            });

            strengthBar.value = strength;
            let strengthLabel = document.getElementById('strength-label');

            // Setting the text and color of label based on the strength
            switch (strength) {
                case 0:
                case 1:
                    strengthLabel.textContent = 'Very Weak';
                    strengthLabel.style.color = 'red';
                    break;
                case 2:
                    strengthLabel.textContent = 'Weak';
                    strengthLabel.style.color = 'orange';
                    break;
                case 3:
                    strengthLabel.textContent = 'Moderate';
                    strengthLabel.style.color = 'yellow';
                    break;
                case 4:
                    strengthLabel.textContent = 'Strong';
                    strengthLabel.style.color = 'blue';
                    break;
                case 5:
                    strengthLabel.textContent = 'Very Strong';
                    strengthLabel.style.color = 'green';
                    break;
            }
        }
    </script>
</head>

<body>
    <!-- Including the header from a separate PHP file -->
    <?php include 'includes/header.php'; ?>
    <main>
        <!-- Main container for the signup form -->
        <div class="signup-container col-md-6">
            <form action="signup.php" method="POST">
                <h1>Sign Up to Residence Revive</h1>
                <button type="button" class="google-signup">Sign up with Google</button>
                <!-- The link to the login page for the users who already have an account registered with us -->
                <p>Already have an account? <a href="../Pages/login.php">Log In</a></p>
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required
                    oninput="checkPasswordStrength(this.value)">
                <progress id="strength-bar" max="5" value="0"></progress>
                <!-- The label to display password strength text -->
                <span id="strength-label">Very Weak</span>
                <input type="submit" value="Create Account">
                <p>By creating an account you agree to our <a href="#">Terms of Service</a> and <a href="#">Notification
                        Setting</a></p>
            </form>
        </div>
    </main>
    <!-- Including the footer from a separate PHP file -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>