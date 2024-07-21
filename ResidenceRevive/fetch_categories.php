// fetch_categories.php
<?php
if (!function_exists('getAllCategories')) {
    function getAllCategories($conn) {
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);

        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }
}

$categories = getAllCategories($conn);
