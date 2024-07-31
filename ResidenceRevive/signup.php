<!-- We are starting the session in order to track user login and other session-related information -->
<?php session_start(); ?>

<?php
$first_name = $last_name = $email = $phone = $password = "";
$first_name_err = $last_name_err = $email_err = $phone_err = $password_err = $email_phone_err = "";

// Including the database configuration file to establish a db connection
include 'config/db.php';
include 'includes/functions.php';

$categories = getAllCategories($conn); // Fetch category names

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Validate first name
    if (empty($_POST["first_name"])) {
        $first_name_err = "First name is required.";
    } else {
        $first_name = htmlspecialchars($_POST["first_name"]);
    }

    // Validate last name
    if (empty($_POST["last_name"])) {
        $last_name_err = "Last name is required.";
    } else {
        $last_name = htmlspecialchars($_POST["last_name"]);
    }

    // Validate email
    if (empty($_POST["email"])) {
        $email_err = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // Validate phone
    if (empty($_POST["phone"])) {
        $phone_err = "Phone is required.";
    } elseif (!empty($_POST["phone"]) && !preg_match("/^[0-9]{10}$/", $_POST["phone"])) {
        $phone_err = "Invalid phone number. Please enter a valid 10-digit number.";
    } else {
        $phone = htmlspecialchars($_POST["phone"]);
    }

    // Validate message
    if (empty($_POST["password"])) {
        $password_err = "Password is required.";
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err) && empty($phone_err)) {
        // Check if the email or phone number already exists
        $sql_check = "SELECT * FROM user_details WHERE email = ? OR contact_number = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ss", $email, $phone);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Email or phone number already exists
            $email_phone_err = "Email or phone number already exists.";
            $stmt_check->close();
            $conn->close();
        } else {
            $stmt_check->close();
        }
    }

    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err) && empty($phone_err) && empty($email_phone_err)) {
        // Get the user input from the POST request
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Preparing the query to insert the user details into the database
        $sql = "INSERT INTO user_details (email, first_name, last_name, contact_number, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $email, $first_name, $last_name, $phone, $password);

        // If the insertion done by the user was successful, then store a success message in the session
        if ($stmt->execute()) {
            $_SESSION['db_message'] = "New record created successfully";

            // login the user on signup
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;

            $_SESSION['signup_message'] = "User Registered Successfully";
        } else {
            $_SESSION['db_message'] = "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirecting the user to the signup page        
        header('Location: signup.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- The link to external CSS stylesheets -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

            // Testing the password and increasing its strength for each match
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
                    strengthLabel.style.color = 'blue';
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
    <!-- Main container for the signup form -->
    <div class="signup-container col-md-6 my-10">
        <form action="signup.php" method="POST">
            <h1>Sign Up to Residence Revive</h1>
            <div>
                <!-- <button type="button" class="google-signup">Sign up with Google</button> -->
                <p>Already have an account? <a href="login.php" style="color: #004DA3;">Login</a></p>
            </div>
                <?php if (isset($_SESSION['signup_message'])): ?>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6 py-2">
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <?php echo $_SESSION['signup_message'];
                                unset($_SESSION['signup_message']); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <!-- The link to the login page for the users who already have an account registered with us -->
            <div class="form-group">
                <span class="error"><?php echo $email_phone_err; ?></span>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
                <span class="error"><?php echo $first_name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
                <span class="error"><?php echo $last_name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone"  name="phone" value="<?php echo $phone; ?>">
                <span class="error"><?php echo $phone_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"  id ="password" name="password" oninput="checkPasswordStrength(this.value)">
                <span class="error"><?php echo $password_err; ?></span>
                <progress id="strength-bar" max="5" value="0"></progress>
                <!-- The label to display password strength text -->
                <span id="strength-label">Very Weak</span>
            </div>
            <input type="submit" value="Create Account">
            <p>By creating an account you agree to our <a href="terms_and_conditions.php" style="color: #004DA3;">Terms and Conditions</a></p>
        </form>
    </div>
    <!-- Including the footer from a separate PHP file -->
    <?php include 'includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
