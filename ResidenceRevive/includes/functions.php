<?php
// Created the function to retrieve all categories from the database
function getAllCategories($conn) {
    $sql = "SELECT category_id, category_name FROM categories"; // Assuming the correct table name is 'categories'
    $result = $conn->query($sql);
    $categories = [];

     // Checking if the query returned any results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    return $categories;
}
?>
