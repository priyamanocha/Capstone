<?php

session_start();

require 'config/db.php';


// store cart items of logined user in cart table - database

//  only logged in user can add items to cart
if(!isset($_SESSION['email'])){
    header('Location: login.php');
    exit;
}


if (isset($_POST['service_id'], $_POST['category_id'], $_POST['sub_category_id'], $_POST['quantity'], $_SESSION['email'])) {
    $service_id = $_POST['service_id'];
    $category_id = $_POST['category_id'];
    $sub_category_id = $_POST['sub_category_id'];
    $quantity = $_POST['quantity'];
    $email = $_SESSION['email'];

    // Check if the service_id already exists in the cart for the user
    $sql = "SELECT * FROM cart WHERE email = ? AND service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the quantity if the service_id exists
        $sql = "UPDATE cart SET quantity = ?, category_id = ?, subcategory_id = ? WHERE email = ? AND service_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisi", $quantity, $category_id, $sub_category_id, $email, $service_id);
    } else {
        // Insert the new service into the cart
        $sql = "INSERT INTO cart (email, category_id, subcategory_id, service_id, quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiii", $email, $category_id, $sub_category_id, $service_id, $quantity);
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Service added to cart']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    }
    $stmt->close();
    $conn->close();
    header("Location: cart.php");
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Required fields are missing']);
    exit;
}
?>