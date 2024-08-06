<?php
// Start session
session_start();

// Include database connection
include 'config/db.php';

header('Content-Type: application/json');

// Initialize search results array
$search_results = [];

// Check if the search query is set
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Sanitize the query to prevent SQL injection
    $query = mysqli_real_escape_string($conn, $query);

    // Search the database for services
    $sql =   "SELECT cat.category_id, ser.service_name FROM services ser, sub_categories sub, categories cat,category_subcategory_service_mapping mapping where mapping.service_id = ser.service_id and mapping.sub_category_id = sub.sub_category_id and mapping.category_id = cat.category_id and ser.service_name LIKE '%$query%'";
    // $sql = "SELECT * FROM services WHERE service_name LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch all search results
        $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
        exit;
    }
}

// Return results as JSON
echo json_encode($search_results);
?>
