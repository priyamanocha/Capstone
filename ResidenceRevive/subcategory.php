<?php
// Include necessary files
include 'config/db.php'; // Adjust path as per your file structure
include 'includes/functions.php'; // Adjust path as per your file structure
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/subcategory.css"> <!-- Link to external CSS file -->
    <title>Subcategories</title>
</head>
<body>
    
    <!-- Subcategories Section -->
    <div class="subcategories">
        <h3>Services</h3>
        <div class="subcategory">
            <?php
            // Fetch category_id and sub_category_id from the URL
            $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
            $sub_category_id = isset($_GET['sub_category_id']) ? intval($_GET['sub_category_id']) : 0;

            // Fetch subcategories based on the selected category
            $subcategories = getSubCategories($conn, $category_id);

            foreach ($subcategories as $subcategory) {
                // Fetch services based on the subcategory id
                $services = getServicesBySubCategory($conn, $subcategory['sub_category_id']);
            ?>
            <div class="subcategory-card" data-sub-category-id="<?php echo $subcategory['sub_category_id']; ?>">
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
                <div class="subcategory-info">
                    <h2><?php echo $subcategory['sub_category_name']; ?></h2>
                    <?php if (isset($subcategory['description'])): ?>
                        <p><?php echo $subcategory['description']; ?></p>
                    <?php else: ?>
                        <!-- <p>No description available.</p> -->
                    <?php endif; ?>
                    <a href="#" class="view-services" data-sub-category-id="<?php echo $subcategory['sub_category_id']; ?>">View Services</a>
                </div>
                
                <!-- Services List -->
                <div class="services-list" id="services_<?php echo $subcategory['sub_category_id']; ?>">
                    <?php foreach ($services as $service): ?>
                        <div class="sub_service-card">
                            <div>
                                <h4><?php echo $service['service_name']; ?></h4>
                                <p><?php echo $service['description']; ?></p>
                            </div>
                            <div class="service-info">
                                <form action="add_to_cart.php" method="post">
                                    <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">
                                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                    <input type="hidden" name="sub_category_id" value="<?php echo $subcategory['sub_category_id']; ?>">
                                    <input type="number" name="quantity" value="1" min="1">
                                    <button type="submit">Add to Cart</button>
                                </form>
                                <span class="service-price">$<?php echo $service['price']; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <a href="#" class="hide-services" data-sub-category-id="<?php echo $subcategory['sub_category_id']; ?>" style="display: none;">Hide Services</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript to handle View Services click event -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const viewServicesLinks = document.querySelectorAll('.view-services');
            const hideServicesLinks = document.querySelectorAll('.hide-services');

            viewServicesLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const subCategoryId = link.getAttribute('data-sub-category-id');
                    const servicesList = document.getElementById(`services_${subCategoryId}`);
                    const hideLink = document.querySelector(`.hide-services[data-sub-category-id='${subCategoryId}']`);

                    // Show services list and hide view link
                    servicesList.classList.add('show-services');
                    link.style.display = 'none';
                    hideLink.style.display = 'inline';
                });
            });

            hideServicesLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const subCategoryId = link.getAttribute('data-sub-category-id');
                    const servicesList = document.getElementById(`services_${subCategoryId}`);
                    const viewLink = document.querySelector(`.view-services[data-sub-category-id='${subCategoryId}']`);

                    // Hide services list and show view link
                    servicesList.classList.remove('show-services');
                    link.style.display = 'none';
                    viewLink.style.display = 'inline';
                });
            });
        });
    </script>
</body>
</html>
