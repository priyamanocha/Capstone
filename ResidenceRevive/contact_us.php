<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $company = htmlspecialchars($_POST['company']);
    $industry = htmlspecialchars($_POST['industry']);
    $subscribe = isset($_POST['subscribe']) ? 1 : 0;
    $phone_calls = isset($_POST['phone_calls']) ? 1 : 0;

    // Database connection
    $db = new mysqli('localhost', 'root', '', 'residence_revive');

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $stmt = $db->prepare("INSERT INTO contact_us (first_name, last_name, email, phone, company, industry, subscribe, phone_calls) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssii", $first_name, $last_name, $email, $phone, $company, $industry, $subscribe, $phone_calls);

    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }

    $stmt->close();
    $db->close();
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact_styles.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <div class="contact-page-container">
            <div class="contact-info">
                <h2>Contact Business Solutions Sales</h2>
                <p>Already a customer or need help with a billing issue? <a href="#">Contact Support</a></p>
                <p><strong>Canada:</strong> +1 999 888 7777</p>
                <p><strong>Canada Sales:</strong> Fill out your details to be contacted.</p>
                <div class="contact-social-media">
                    <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="images/instagram.png" alt="Instagram"></a>
                </div>
            </div>
            <div class="contact-form-container">
                <h1>Contact Us</h1>
                <p>Fill out the form and a member from our sales team will get back to you within 24 hours, or scroll
                    down for more ways to get in touch.</p>
                <form action="contact_us.php" method="POST">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@yoursite.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <label for="company">Company Name (If no, Fill NA)</label>
                        <input type="text" id="company" name="company" placeholder="Company Name">
                    </div>
                    <div class="form-group">
                        <label for="industry">Industry</label>
                        <select id="industry" name="industry">
                            <option value="">Select an Industry</option>
                            <option value="tech">Tech</option>
                            <option value="finance">Finance</option>
                            <option value="health">Health</option>
                            <option value="NA">NA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="subscribe" name="subscribe">
                        <label for="subscribe">Yes, I would like to receive news and offers from ACTIVE via
                            email</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="phone_calls" name="phone_calls">
                        <label for="phone_calls">Yes, I agree to receive phone calls from ACTIVE</label>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>