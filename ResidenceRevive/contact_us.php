<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config/db.php';
include 'includes/functions.php';

$categories = getAllCategories($conn); // Fetch category names

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
            $_SESSION['contact_us_message'] = "Your message has been received. Our team will get back to you within 24 hours.";
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
    <meta name="description" content="Residence Revive offers hassle-free and reliable home services, including housekeeping, pest control, appliance repair, and more. Our team of professionals ensures your home is in perfect condition using advanced techniques and eco-friendly products.">
    <title>Contact Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <div class="background-image-container">
            <a href="#contact-page-container">
                <h1 class="mb-2">Contact Us</h1>
            </a>
        </div>
        <div class="container">
            <?php if (isset($_SESSION['contact_us_message'])): ?>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 py-2">
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <?php echo $_SESSION['contact_us_message'];
                            unset($_SESSION['contact_us_message']); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="contact-page-container" id="contact-page-container">
            <div class="contact-info">
                <h2>Contact Customer Support</h2>
                <p><b>Email:</b> <a href="mailto:support@residencerevive.com" style="color: black;">support@residencerevive.com</a></p>
<p><b>Phone:</b> <a href="tel:+1234567890" style="color: black;">+1 (234) 567-890</a></p>
                <p><b>Address:</b> 21 Sportsman Hill St, Kitchener, Ontario, N2P L63.</p>
                <div class="social-links-contact-us">
                <a href="#" class="icon-facebook" aria-label="Facebook"><i class="fab fa-facebook" aria-hidden="true"></i></a>
<a href="#" class="icon-instagram" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
<a href="#" class="icon-twitter" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
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
                        <textarea id="message" name="message" placeholder="Enter Message"></textarea>
                        <span class="error"><?php echo $message_err; ?></span>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
