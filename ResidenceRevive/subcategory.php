<?php
// Include necessary files
include 'config/db.php';
include 'includes/functions.php';
include 'includes/header.php';

// Fetch category_id from the URL
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Fetch subcategories based on the selected category
$subcategories = getSubCategories($conn, $category_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcategories</title>
    <link rel="stylesheet" href="css/subcategory.css"> <!-- Link to external CSS file -->
</head>
<body>
    <h2>Subcategories</h2>
    <div class="subcategory">
        <?php foreach ($subcategories as $subcategory): ?>
            <div class="subcategory-card">
                <!-- Example: Using a predefined array of icons -->
                <?php 
                    // Example array of icons (you can modify this to fit your actual icons)
                    $sub_icons = [
                        'Bathroom Cleaning' => './images/bathroom.png',
                        'Kitchen Cleaning' => './images/kitchen.png',
                        'Carpet Cleaning' => './images/adornment.png',
                        'Home Cleaning' => './images/house.png',
                        // Add more subcategories with their respective icon paths
                    ];
                ?>
                <?php if (isset($sub_icons[$subcategory['sub_category_name']])): ?>
                    <img src="<?php echo $sub_icons[$subcategory['sub_category_name']]; ?>"
                        alt="<?php echo $subcategory['sub_category_name']; ?> icon" class="subcategory-icon">
                <?php else: ?>
                    <img src="images/default.png" alt="Default icon" class="subcategory-icon"> <!-- Fallback icon -->
                <?php endif; ?>
                <h2><?php echo $subcategory['sub_category_name']; ?></h2>
                <a href="services.php?category_id=<?php echo $category_id; ?>&sub_category_id=<?php echo $subcategory['sub_category_id']; ?>">View Services</a>
                
                <!-- Services List Placeholder -->
                <div class="services-list" id="services_<?php echo $subcategory['sub_category_id']; ?>"></div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript to fetch and display services dynamically -->
    <script>
        // Function to fetch services via AJAX
        function fetchServices(subCategoryId) {
            fetch(`get_services.php?sub_category_id=${subCategoryId}`)
                .then(response => response.json())
                .then(data => {
                    const servicesList = document.getElementById(`services_${subCategoryId}`);
                    servicesList.innerHTML = ''; // Clear previous content
                    data.forEach(service => {
                        const serviceItem = document.createElement('div');
                        serviceItem.classList.add('service-item');
                        serviceItem.innerHTML = `
                            <h4>${service.service_name}</h4>
                            <form action="add_to_cart.php" method="post">
                                <input type="hidden" name="service_id" value="${service.service_id}">
                                <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                <input type="hidden" name="sub_category_id" value="${subCategoryId}">
                                <input type="number" name="quantity" value="1" min="1">
                                <button type="submit">Add to Cart</button>
                            </form>
                        `;
                        servicesList.appendChild(serviceItem);
                    });
                })
                .catch(error => console.error('Error fetching services:', error));
        }

        // Attach click event handlers to "View Services" links
        document.addEventListener('DOMContentLoaded', () => {
            const viewServicesLinks = document.querySelectorAll('.subcategory-card a');
            viewServicesLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const subCategoryId = link.getAttribute('data-sub-category-id');
                    fetchServices(subCategoryId);
                });
            });
        });
    </script>
</body>
</html>
