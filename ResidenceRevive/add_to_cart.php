<?php
session_start();
include 'config/db.php'; // Adjust path as per your file structure
include 'includes/functions.php'; // Adjust path as per your file structure

// Assuming user is logged in and user email is stored in session
$user_email = $_SESSION['user_email'] ?? '';

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];
    $category_id = $_POST['category_id'];
    $sub_category_id = $_POST['sub_category_id'];
    $quantity = $_POST['quantity'];

    // Add to cart function (You should implement this function in your functions.php file)
    addToCart($conn, $user_email, $category_id, $sub_category_id, $service_id, $quantity);

    // Redirect to the cart page after adding item to cart
    header("Location: cart.php");
    exit();
}

function addToCart($conn, $user_email, $category_id, $sub_category_id, $service_id, $quantity) {
    // Check if the item is already in the cart
    $sql = "SELECT * FROM cart WHERE email = ? AND category_id = ? AND subcategory_id = ? AND service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $user_email, $category_id, $sub_category_id, $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the quantity if the item is already in the cart
        $sql = "UPDATE cart SET quantity = quantity + ? WHERE email = ? AND category_id = ? AND subcategory_id = ? AND service_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isiii", $quantity, $user_email, $category_id, $sub_category_id, $service_id);
    } else {
        // Insert a new row if the item is not in the cart
        $sql = "INSERT INTO cart (email, category_id, subcategory_id, service_id, quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiii", $user_email, $category_id, $sub_category_id, $service_id, $quantity);
    }

    $stmt->execute();
    $stmt->close();
}
?>
