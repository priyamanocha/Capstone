<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config/db.php';
$first_name = $last_name = $email = $phone = $message = "";
$first_name_err = $last_name_err = $email_err = $phone_err = $message_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    if (empty($_POST["message"])) {
        $message_err = "Message is required.";
    } else {
        $message = htmlspecialchars($_POST["message"]);
    }

    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($phone_err) && empty($message_err)) {

        $stmt = $conn->prepare("INSERT INTO contact_us (first_name, last_name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $message);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Your message has been received. Our team will get back to you within 24 hours.');
                    window.setTimeout(function(){ window.location.href = 'index.php'; }, 1000);
                    exit;
                  </script>";
        } else {
            echo "<script>alert('Failed to send message.');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <main>
    <div class="background-image-container">
        <h1 class="mb-2">Contact Us</h1>
    </div>
        <div class="contact-page-container">
            <div class="contact-info">
                <h2>Contact Customer Support</h2>
                <p><b>Email:</b> <a href="mailto:support@residencerevive.com">support@residencerevive.com</a></p>
                <p><b>Phone:</b> <a href="tel:+1234567890">+1 (234) 567-890</a></p>
                <p><b>Address:</b> 21 Sportsman Hill St, Kitchener, Ontario, N2P L63.</p>
                <div class="social-links-contact-us">
                    <a href="#" class="icon-facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="icon-instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="icon-twitter"><i class="fab fa-twitter"></i></a>
                </div>

            </div>
            <div class="contact-form-container">
                <h1>Contact Us</h1>
                <p>Fill out the form and our team will get back to you within 24 hrs.</p>
                <form id="contactForm" action="contact_us.php" method="POST">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Enter First Name"
                            value="<?php echo $first_name; ?>">
                        <span class="error"><?php echo $first_name_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name"
                            value="<?php echo $last_name; ?>">
                        <span class="error"><?php echo $last_name_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter Email"
                            value="<?php echo $email; ?>">
                        <span class="error"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" placeholder="Enter Phone Number"
                            value="<?php echo $phone; ?>">
                        <span class="error"><?php echo $phone_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Enter Message"
                            value="<?php echo $message; ?>"></textarea>
                        <span class="error"><?php echo $message_err; ?></span>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>