<?php
// includes/functions.php
function getAllServices($conn) {
    $sql = "SELECT service_id, service_name FROM services";
    $result = $conn->query($sql);
    $services = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    }

    return $services;
}
?>
