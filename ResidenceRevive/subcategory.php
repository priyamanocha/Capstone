<?php
// Include necessary files
include 'config/db.php'; // Adjust path as per your file structure
include 'includes/functions.php'; // Adjust path as per your file structure

$categories = getAllCategories($conn); // Fetch category names


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Residence Revive offers hassle-free and reliable home services, including housekeeping, pest control, appliance repair, and more. Our team of professionals ensures your home is in perfect condition using advanced techniques and eco-friendly products.">
    <link rel="stylesheet" href="css/subcategory.css"> <!-- Link to external CSS file -->
    <title>Services</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
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
                    'Bathroom Cleaning' => './images/service-images/BathroomCleaning.jpg',
                    'Kitchen Cleaning' => './images/service-images/KitchenCleaning.jpg',
                    'Carpet Cleaning' => './images/service-images/CarpetCleaning.jpg',
                    'Home Cleaning' => './images/service-images/HomeCleaning.jpg',
                    'Refrigerator'=> './images/service-images/Refrigerator.jpg',
                    'Microwave'=> './images/service-images/Microwave.jpg',
                    'Induction'=> './images/service-images/Induction.jpg',
                    'Chimney'=> './images/service-images/Chimney.jpg',
                    'Washer'=> './images/service-images/Washer.jpg',
                    'Dryer'=> './images/service-images/Dryer.jpg',
                    'Dish Washer'=> './images/service-images/DishWasher.jpg',
                    'Switch and Socket'=> './images/service-images/SwitchandSocket.jpg',
                    'Light'=> './images/service-images/Light.jpg',
                    'Doorbell'=> './images/service-images/Doorbell.jpg',
                    'Television'=> './images/service-images/Television.jpg',
                    'Expert Consultation'=> './images/service-images/ExpertConsultation.jpg',
                    'Wardrobe'=> './images/service-images/Wardrobe.jpg',
                    'Tables/Drawers/Workspaces'=> './images/service-images/TablesDrawersWorkspaces.jpg',
                    'Bed'=> './images/service-images/Bed.jpg',
                    'Sofa'=> './images/service-images/Sofa.jpg',
                    'Tap'=> './images/service-images/Tap.jpg',
                    'Basin & Sink'=> './images/service-images/BasinSink.jpg',
                    'Bath fittings'=> './images/service-images/Bathfittings.jpg',
                    'Minor Fitting/Installation'=> './images/service-images/MinorFittingInstallation.jpg',
                    'Toilet'=> './images/service-images/Toilet.jpg',
                    'Shower'=> './images/service-images/Shower.jpg',
                    'Insects'=> './images/service-images/insects.jpg',
                    'Rodents'=> './images/service-images/rodents.jpg',
                    'Others'=> './images/service-images/Others.jpg',
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
