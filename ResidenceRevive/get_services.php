<?php
// Include necessary files
include 'config/db.php'; // Adjust path as per your file structure
include 'includes/functions.php'; // Adjust path as per your file structure

// Check if sub_category_id is provided in the query string
$sub_category_id = isset($_GET['sub_category_id']) ? intval($_GET['sub_category_id']) : 0;

// Fetch services based on the sub_category_id
$services = getServicesBySubCategory($conn, $sub_category_id);

// Output services as JSON
header('Content-Type: application/json');
echo json_encode($services);
?>
