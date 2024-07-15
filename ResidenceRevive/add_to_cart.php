<?php
session_start();

if (isset($_POST['service_id'])) {
    $_SESSION['cart'][] = $_POST['service_id'];
    $_SESSION['cart'] = array_unique($_SESSION['cart']);
    echo json_encode(['status' => 'success', 'message' => 'Service added to cart']);
    header("Location: cart.php");
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Service ID is missing']);
    exit;
}
?>
