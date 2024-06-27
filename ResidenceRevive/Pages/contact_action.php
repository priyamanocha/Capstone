<?php
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
} else {
    echo "Invalid request.";
}
?>
