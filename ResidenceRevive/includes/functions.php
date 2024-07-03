<?php
function getAllCategories($conn)
{
    $categories = [];

    try {
        $sql = "SELECT category_id, category_name FROM categories";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
    } catch (Exception $e) {
        // Handle exception (e.g., log it, display an error message)
        error_log("Error fetching categories: " . $e->getMessage());
    }

    return $categories;
}

function getSubCategories($conn, $category_id)
{
    $sql = "SELECT  DISTINCT sc.sub_category_id, sc.sub_category_name 
            FROM sub_categories sc
            INNER JOIN category_subcategory_service_mapping csm ON sc.sub_category_id = csm.sub_category_id
            WHERE csm.category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $subcategories = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subcategories[] = $row;
        }
    }

    $stmt->close();
    return $subcategories;
}

// Function to fetch services based on sub_category_id
function getServicesBySubCategory($conn, $sub_category_id)
{
    $sql = "SELECT s.service_id, s.service_name, s.description, s.price
            FROM services s
            INNER JOIN category_subcategory_service_mapping csm ON s.service_id = csm.service_id
            WHERE csm.sub_category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sub_category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $services = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    }

    $stmt->close();
    return $services;
}
?>
